App = (function($){
	
	function EventListener(){
		this._listeners = {};
	}
	EventListener.prototype.emit = function(event){
		if(this._listeners[event]){
			var params = [].slice.call(arguments, 1);
			var handlers = this._listeners[event]
			for(var index in handlers){
				handlers[index].apply(this, params);
			}
		}
	};
	EventListener.prototype.on = function(event, handler){
		if(this._listeners[event]){
			this._listeners[event].push(handler);
		}else{
			this._listeners[event] = [handler];
		}
	};
	EventListener.prototype.off = function(event, handler){
		if(handler){
			var handlers = this._listeners[event];
			if(handlers){
				for(var index in handlers){
					if(handlers[index] === handler){
						handlers.slice(index, 1);
					}
				}
			}
		}else{
			delete this._listeners[event];
		}
	};
	
	var observer = function(obj){
		obj || (obj = {});
		var event = new EventListener();
		return {
			get: function(name){
				return obj[name];
			},
			set: function(name, value, options){
				var oldValue = obj[name];
				obj[name] = value;
				if(!options || !options.silent){
					event.emit(name, value, oldValue);
				}
			},
			on: function(name, handler){
				event.on(name, handler);
			},
			off: function(name, handler){
				event.off(name, handler);
			}
		};
	};
	
	var bindStatic = function(model, name, $elem){
		model.on(name, function(value){
			$elem.html(value);
		});
		$elem.html(model.get(name));
	};
	var bindDynamic = function(model, name, $elem, noListener){
		if(!noListener){
			model.on(name, function(value){
				$elem.val(value);
			});
		}
		$elem.val(model.get(name));
		$elem.on('keyup', function(){
			model.set(name, $elem.val());
		});
	};
	
	function throttle(func, wait) {
		var context, args, result;
		var timeout = null;
		var previous = 0;
		var later = function() {
			previous = 0;
			timeout = null;
			result = func.apply(context, args);
		};
		return function() {
			var now = new Date;
			if(!previous)
				previous = now;
			var remaining = wait - (now - previous);
			context = this;
			args = arguments;
			if(remaining <= 0){
				clearTimeout(timeout);
				timeout = null;
				previous = now;
				result = func.apply(context, args);
			}else if(!timeout){
				timeout = setTimeout(later, remaining);
			}
			return result;
		};
	};
	
	var App = {
		endpoint: ''
	};
	
	var foodList;
	
	App.setFood = function(foodData){
		foodList = {};
		var item;
		for(var index in foodData){
			item = foodData[index];
			foodList[item.id] = observer(item);
		}
	};
	
	App.bindFood = function(elems){
		elems.each(function(index, elem){
			var $elem = $(elem);
			var id = $elem.data('id');
			var food = foodList[id];
			bindDynamic(food, 'description', $elem.find('.attr-description'), true);
			bindStatic(food, 'user', $elem.find('.attr-user'));
			
			food.on('description', throttle(function(value){
				$.post(App.endpoint+'/change?id='+id, {description: value}, function(){
					if(value){
						$elem.find('.attr-user').removeClass('hidden');
					}else{
						$elem.find('.attr-user').addClass('hidden');
					}
				});
			}, 500));
		});
	};
	
	function initComment(elem){
		var postId = elem.data('post-id');
		var newCommentForm = elem.find('.new-comment');
		var comments = elem.find('.comments-list');
		
		var commentMeta = observer({
			showCommentsText: elem.find('.show-comments').html(),
			formErrors: '',
			textarea: ''
		});
		bindStatic(commentMeta, 'showCommentsText', elem.find('.show-comments'));
		bindStatic(commentMeta, 'formErrors', newCommentForm.find('.errors'));
		bindDynamic(commentMeta, 'textarea', newCommentForm.find('textarea'));
		
		comments.hide();
		elem.find('.show-comments').click(function(evt){
			evt.preventDefault();
			comments.slideToggle(250);
		});
		refreshComments();
		
		function refreshComments(){
			$.get(App.endpoint + '/comments/list?post_id=' + postId, function(result){
				comments.html('');
				if(result.length == 0){
					commentMeta.set('showCommentsText', "Aucun commentaire");
				}else{
					if(result.length == 1){
						commentMeta.set('showCommentsText', "1 commentaire");
					}else{
						commentMeta.set('showCommentsText', result.length + " commentaires");
					}
					for(var i in result)
						comments.append(generateComment(result[i]));
				}
			});
		}
		function generateComment(comment){
			return $('<div class="comment"></div>')
				.append($('<div class="user"></div>').text(comment.user.name))
				.append($('<div class="content"></div>').text(comment.content));
		}
		
		function submitComment(){
			var commentContent = commentMeta.get('textarea');
			commentMeta.set('textarea', '');
			$.post(newCommentForm.attr('action'), {content: commentContent}, function(data){
				if(data.result == 'success'){
					refreshComments();
				}else{
					if(data.error){
						commentMeta.set('formErrors', data.error);
					}else if(data.errors){
						var errors = [];
						var index;
						for(var attribute in data.errors){
							for(index in data.errors[attribute])
								errors.push(data.errors[attribute][index]);
						}
						commentMeta.set('formErrors', errors.join("<br>\n"));
					}else{
						commentMeta.set('formErrors', "Erreur inconnue");
					}
				}
			});
		}
		newCommentForm.on('keypress', function(evt){
			commentMeta.set('formErrors', '');
			if(evt.which === 13){
				evt.preventDefault();
				submitComment();
			}
		});
	}
	
	App.initComments = function(elems){
		elems.each(function(){
			initComment($(this));
		});
	};
	
	return App;
	
}(jQuery));