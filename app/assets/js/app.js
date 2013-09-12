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
				return obj[name]
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
		}
	};
	
	var bindStatic = function(model, name, $elem){
		model.on(name, function(value){
			$elem.html(value);
		});
		$elem.html(model.get(name));
	};
	var bindDynamic = function(model, name, $elem){
		model.on(name, function(value){
			$elem.val(value);
		});
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
			bindDynamic(food, 'description', $elem.find('.attr-description'));
			bindStatic(food, 'user', $elem.find('.attr-user'));
			
			food.on('description', throttle(function(value){
				$.post(App.endpoint+'/change?id='+id, {description: value});
			}, 500));
		});
	};
	
	App.test = function(input, div){
		var model = observer();
		model.set('test', "Initial value");
		bindStatic(model, 'test', $(div));
		bindDynamic(model, 'test', $(input));
	};
	
	return App;
	
}(jQuery));