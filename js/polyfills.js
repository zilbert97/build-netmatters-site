Array.prototype.find||Object.defineProperty(Array.prototype,"find",{value:function(t){if(null==this)throw TypeError('"this" is null or not defined');var r=Object(this),e=r.length>>>0;if("function"!=typeof t)throw TypeError("predicate must be a function");for(var i=arguments[1],n=0;n<e;){var o=r[n];if(t.call(i,o,n,r))return o;n++}},configurable:!0,writable:!0}),String.prototype.startsWith||Object.defineProperty(String.prototype,"startsWith",{value:function(t,r){var e=r>0?0|r:0;return this.substring(e,e+t.length)===t}});
