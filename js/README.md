# debug js
```javascript
var getStackTrace = function() {
  var obj = {};
  Error.captureStackTrace(obj, getStackTrace);
  return obj.stack;
};
console.log(getStackTrace());
```
-----------------
# jq set attribute value
```javascript
elem.setAttribute( name, value + "" );
```
-----------------
# get object method list
```javascript
function getMethods(object) {
    var methodList = [];
    for (var property in object) {
        if (typeof object[property] === 'function') {
            methodList.push(property);
        }
    }
    return methodList;
}
```
-----------------
# reload customer data
```javascript
require([
    'jquery',
    'Magento_Customer/js/customer-data'
], function ($, customerData) {
  customerData.reload(['gtm']);
  var data = customerData.get('gtm');
  console.log(data());
});
```
-----------------

# debug knockout
```javascript
require('ko').contextFor($0);
```
-----------------
# magento file uploader uses dispersion param

```javascript
window.matchMedia('(min-width: 768px)')
```
-----------------
# timer

```javascript
var myCustomTimerFlag=1,hour=0,minute=0,second=0,count=0;
function myCustomTimer(){
if(myCustomTimerFlag){count++;
if(count==100){second++;count=0;}
if(second==60){minute++;second=0;}
if(minute==60){hour++;minute=0;second=0;}
let hrString=hour,minString=minute,secString=second,countString=count;
if(hour<10){hrString="0"+hrString;}
if(minute<10){minString="0"+minString;}
if(second<10){secString="0"+secString;}
if(count<10){countString="0"+countString;}
console.log(minString+":"+secString+":"+countString);
setTimeout(myCustomTimer,10);}}myCustomTimer();
myCustomTimerFlag=0
```
