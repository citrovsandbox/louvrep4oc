(window.webpackJsonp=window.webpackJsonp||[]).push([[0],{63:function(e,t){var a={_url:"http://4348d109.ngrok.io",_cache:{},_isDebugMode:!1,get:function(e,t){var a=this._url+e;return new Promise(function(e,t){fetch(a,{method:"GET",headers:{Accept:"application/json","Content-Type":"application/json"}}).then(function(a){console.log(a),a.json().then(function(t){console.log(t),e(t)}).catch(function(e){t(e)})}).catch(function(e){t(e)})})},post:function(e,t){var a=this._url+e;return new Promise(function(e,n){fetch(a,{method:"POST",headers:{Accept:"application/json, text/plain, */*","Content-Type":"application/json"},body:JSON.stringify(t)}).then(function(t){console.log(t),t.json().then(function(t){e(t)}).catch(function(e){n(e)})}).catch(function(e){n(e)})})},put:function(e,t){console.log(t);var a=this._url+e;return console.log(a),new Promise(function(e,n){fetch(a,{method:"PUT",headers:{Accept:"application/json, text/plain, */*","Content-Type":"application/json"},body:JSON.stringify(t)}).then(function(t){console.log(t),t.json().then(function(t){e(t)}).catch(function(e){n(e)})}).catch(function(e){n(e)})})},patch:function(e,t){var a=this._url+e;return new Promise(function(e,n){fetch(a,{method:"PATCH",headers:{Accept:"application/json, text/plain, */*","Content-Type":"application/json"},body:JSON.stringify(t)}).then(function(t){console.log(t),t.json().then(function(t){e(t)}).catch(function(e){n(e)})}).catch(function(e){n(e)})})},delete:function(e,t){var a=this._url+e;return new Promise(function(e,n){fetch(a,{method:"DELETE",headers:{Accept:"application/json, text/plain, */*","Content-Type":"application/json"},body:JSON.stringify(t)}).then(function(t){console.log(t),t.json().then(function(t){e(t)}).catch(function(e){n(e)})}).catch(function(e){n(e)})})},getCache:function(){return this._cache}};e.exports=a},68:function(e,t,a){e.exports=a(94)},75:function(e,t,a){},93:function(e,t,a){},94:function(e,t,a){"use strict";a.r(t);var n=a(0),r=a.n(n),o=a(12),i=a.n(o),s=(a(73),a(74),a(75),a(8)),l=a(7),c=a(11),u=a(9),m=a(10),p=a(57),d=a.n(p),h=(a(76),a(17)),f=a(37),b=a(36),v={bookingInfo:{},tickets:[],orderInfo:{}};var g=function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:v,t=arguments.length>1?arguments[1]:void 0;switch(t.type){case"UPDATE_BOOKING_INFO":return Object(b.a)({},e,{bookingInfo:t.value});case"UPDATE_TICKETS":return Object(b.a)({},e,{tickets:t.value});case"UPDATE_ORDER_INFO":return Object(b.a)({},e,{orderInfo:t.value});case"UPDATE_TICKET":var a=e.tickets;return a[t.value.index]=t.value.value,Object(b.a)({},e,{tickets:a});default:return e}},E=Object(f.b)(g),N=(r.a.Component,a(59)),y=a.n(N),k=a(38),j=a.n(k),O=a(124),w=a(125),D=a(123),C=a(118),T=a(119),P=a(117),S=a(120),x=a(121),_=a(122),M=function(e){function t(){return Object(s.a)(this,t),Object(c.a)(this,Object(u.a)(t).apply(this,arguments))}return Object(m.a)(t,e),Object(l.a)(t,[{key:"render",value:function(){return r.a.createElement(w.a,{open:this.props.show,onClose:this.props.onClose,"aria-labelledby":"alert-dialog-title","aria-describedby":"alert-dialog-description"},r.a.createElement(P.a,{id:"alert-dialog-title"},"You must provide all the fields"),r.a.createElement(C.a,null,r.a.createElement(T.a,{id:"alert-dialog-description"},"It looks like you didn't provide all necessary informations belonging to the tickets you want to afford. Please try to fix theses points :"),r.a.createElement(S.a,null,this.props.errors.map(function(e){return r.a.createElement(x.a,{button:!0,key:e},r.a.createElement(_.a,{primary:e}))}))),r.a.createElement(D.a,null,r.a.createElement(O.a,{onClick:this.props.onClose,color:"primary"},"OK")))}}]),t}(r.a.Component),I=(a(91),function(e){function t(e){var a;return Object(s.a)(this,t),(a=Object(c.a)(this,Object(u.a)(t).call(this,e))).onNextStepPress=function(){var e={date:a.state.date,visitorsNumber:0!==a.state.visitorsNumber&&NaN!==a.state.visitorsNumber&&""!==a.state.visitorsNumber&&a.state.visitorsNumber>0&&parseInt(a.state.visitorsNumber,10),ticketType:a.state.ticketType,orderMailing:a.state.orderMailing,orderMailingConfirm:a.state.orderMailingConfirm};a._checkBooking(e)&&(a._registerBookingInfo(e),a._registerTickets(e.visitorsNumber),window.scrollTo(0,0),a.props.nextStep())},a.onErrorsModalClose=function(){a.setState({showErrors:!1})},a.isHalfEnabled=function(){console.log("isHalf Enabled triggered");var e=new Date(a.state.date).getDate(),t=(new Date).getDate(),n=(new Date).getHours();return!(e===t&&n>=11)},a._registerBookingInfo=function(e){var t={type:"UPDATE_BOOKING_INFO",value:e};a.props.dispatch(t)},a._registerTickets=function(e){for(var t=[],n=0;n<e;n++)t.push({});var r={type:"UPDATE_TICKETS",value:t};a.props.dispatch(r)},a._checkBooking=function(e){var t=[];return a._ckeckBookingDate(e.date)||t.push("Visit date is invalid"),e.visitorsNumber<=0&&t.push("Visitors number is invalid"),""===e.ticketType&&t.push("Ticket type is invalid"),""!==e.orderMailing&&!1!==a._isEmailValid(e.orderMailing)||t.push("Order email is invalid"),e.orderMailingConfirm!==e.orderMailing&&t.push("You didn't type the same email address"),!(t.length>0)||(a.setState({errors:t,showErrors:!0}),!1)},a._ckeckBookingDate=function(e){return!(0===(e=new Date(e)).getDay()||2===e.getDay()||1===e.getDate()&&4===e.getMonth()||1===e.getDate()&&10===e.getMonth()||25===e.getDate()&&11===e.getMonth()||e<new Date&&e.getDate()!==(new Date).getDate())},a._isEmailValid=function(e){return y.a.validate(e)},a.state={date:new Date,visitorsNumber:0,ticketType:"half",orderMailing:"",orderMailingConfirm:"",showErrors:!1,errors:[]},a}return Object(m.a)(t,e),Object(l.a)(t,[{key:"render",value:function(){var e=this;return r.a.createElement("div",{className:"step"},r.a.createElement("h2",null,"Booking"),r.a.createElement("div",{className:"form-group"},r.a.createElement("label",{className:"form-control-label required"},"Visit date"),r.a.createElement(j.a,{"data-enable-time":!0,id:"visitDateInput",placeholder:"Please select a date for your visit",options:{dateFormat:"d/m/Y",enableTime:!1,disable:[function(e){return 0===e.getDay()||2===e.getDay()||1===e.getDate()&&4===e.getMonth()||1===e.getDate()&&10===e.getMonth()||25===e.getDate()&&11===e.getMonth()||e<new Date&&e.getDate()!==(new Date).getDate()}]},className:"form-control",value:this.state.date,onChange:function(t){e.setState({date:new Date(t)})}}),r.a.createElement("small",{className:"form-text text-muted",style:{textAlign:"justify"}},"Booking not available on sundays. Closed on Tuesdays, the 1st of May, the 1st of November et le 25th of December.")),r.a.createElement("div",{className:"form-group"},r.a.createElement("label",{className:"form-control-label required"},"Number of visitors"),r.a.createElement("input",{type:"number",className:"form-control",value:this.state.visitorsNumber,onChange:function(t){e.setState({visitorsNumber:t.target.value})}})),r.a.createElement("div",{className:"form-group"},r.a.createElement("label",{className:"form-control-label required"},"Ticket type"),r.a.createElement("select",{className:"form-control",value:this.state.ticketType,onChange:function(t){return e.setState({ticketType:t.target.value})}},r.a.createElement("option",{value:"half"},"Half-Day"),r.a.createElement("option",{value:"full",disabled:this.state.date.getDate()===(new Date).getDate()&&(new Date).getHours()>=14},"Full Day")),r.a.createElement("small",{className:"form-text text-muted",style:{textAlign:"justify"}},'The "Half-Day" ticket is only valid from 2pm. Note that you cannot afford a Full-Day ticket from 2pm.')),r.a.createElement("div",{className:"form-group"},r.a.createElement("label",{className:"form-control-label required"},"Mailing address of receipt for the ticket(s)"),r.a.createElement("input",{type:"email",className:"form-control",required:!0,onChange:function(t){return e.setState({orderMailing:t.target.value})}})),r.a.createElement("div",{className:"form-group"},r.a.createElement("label",{className:"form-control-label required"},"Confirm the email address"),r.a.createElement("input",{type:"email",className:"form-control",required:!0,onChange:function(t){return e.setState({orderMailingConfirm:t.target.value})}})),r.a.createElement("div",{className:"form-group nav-line-right"},r.a.createElement("button",{className:"btn btn-primary",onClick:this.onNextStepPress},"Next")),r.a.createElement(M,{show:this.state.showErrors,onClose:this.onErrorsModalClose,errors:this.state.errors}))}}]),t}(r.a.Component)),A=Object(h.b)(function(e){return e})(I),B=a(46),F=a(50),q=a.n(F),L=a(62),X=function(e){function t(e){var a;return Object(s.a)(this,t),(a=Object(c.a)(this,Object(u.a)(t).call(this,e))).onFormChanged=function(){var e=Object(L.a)(q.a.mark(function e(t,n){return q.a.wrap(function(e){for(;;)switch(e.prev=e.next){case 0:e.t0=t,e.next="firstName"===e.t0?3:"lastName"===e.t0?5:"birthDate"===e.t0?7:"country"===e.t0?9:"reduction"===e.t0?11:13;break;case 3:return a.setState({firstName:n},function(){a._updateStore()}),e.abrupt("break",14);case 5:return a.setState({lastName:n},function(){a._updateStore()}),e.abrupt("break",14);case 7:return a.setState({birthDate:n},function(){a._updateStore()}),e.abrupt("break",14);case 9:return a.setState({country:n},function(){a._updateStore()}),e.abrupt("break",14);case 11:return a.setState({reduction:!a.state.reduction},function(){a._updateStore()}),e.abrupt("break",14);case 13:return e.abrupt("return");case 14:case"end":return e.stop()}},e)}));return function(t,a){return e.apply(this,arguments)}}(),a._updateStore=function(){var e={type:"UPDATE_TICKET",value:{index:a.props.index,value:a.state}};a.props.dispatch(e)},a.state={firstName:"",lastName:"",birthDate:new Date,country:"",reduction:!1},a}return Object(m.a)(t,e),Object(l.a)(t,[{key:"render",value:function(){var e=this;return r.a.createElement("div",{className:"contained"},r.a.createElement("h5",null,"Beneficiary #",this.props.beneficiaryNumber),r.a.createElement("div",{className:"form-group"},r.a.createElement("label",{className:"form-control-label required"},"First name"),r.a.createElement("input",{type:"text",maxLength:"35",className:"form-control",value:this.state.firstName,onChange:function(t){return e.onFormChanged("firstName",t.target.value)}})),r.a.createElement("div",{className:"form-group"},r.a.createElement("label",{className:"form-control-label required"},"Last Name"),r.a.createElement("input",{type:"text",maxLength:"35",className:"form-control",value:this.state.lastName,onChange:function(t){return e.onFormChanged("lastName",t.target.value)}})),r.a.createElement("div",{className:"form-group"},r.a.createElement("label",{className:"form-control-label required"},"Birth date"),r.a.createElement(j.a,{"data-enable-time":!0,id:"birthDateInput",placeholder:"We never forgot any birthday",options:{dateFormat:"d/m/Y"},className:"form-control",value:this.state.birthDate,onChange:function(t){return e.onFormChanged("birthDate",t)}}),r.a.createElement("small",{className:"form-text text-muted"},"We'll never share your informations to thirds.")),r.a.createElement("div",{className:"form-group"},r.a.createElement("label",{className:"form-control-label required"},"Country"),r.a.createElement("input",{type:"text",maxLength:"35",className:"form-control",value:this.state.country,onChange:function(t){return e.onFormChanged("country",t.target.value)}})),r.a.createElement("div",{className:"form-group"},r.a.createElement("div",{className:"form-check"},r.a.createElement("input",{type:"checkbox",className:"form-check-input",checked:this.state.reduction,onChange:function(t){return e.onFormChanged("reduction",t.target.value)}}),r.a.createElement("label",{className:"form-check-label"},"Reduction")),r.a.createElement("small",{className:"form-text text-muted"},"Upon presentation of justificative at the museum entrance")))}}]),t}(r.a.Component),U=Object(h.b)(function(e){return e})(X),Y=function(e){function t(e){var a;return Object(s.a)(this,t),(a=Object(c.a)(this,Object(u.a)(t).call(this,e))).onGoToPreviousStepPress=function(e){e.preventDefault(),a.props.goToPrevious()},a.state={},a}return Object(m.a)(t,e),Object(l.a)(t,[{key:"render",value:function(){return console.log(this.props),r.a.createElement("div",{className:"contained"},r.a.createElement("h4",null,"Oops!"),r.a.createElement("p",null,"You have no beneficiary. Why not start by the beginning ?"),r.a.createElement("p",null,r.a.createElement("a",{href:"#step2",onClick:this.onGoToPreviousStepPress},"Go to the first step")))}}]),t}(r.a.Component),H=function(e){function t(e){var a;return Object(s.a)(this,t),(a=Object(c.a)(this,Object(u.a)(t).call(this,e))).onNextStepPress=function(){a._checkTicketsData()&&(window.scrollTo(0,0),a.props.nextStep())},a.onPreviousStepPress=function(){window.scrollTo(0,0),a.props.previousStep()},a.onModalClose=function(){a.setState({showErrors:!1})},a._checkTicketsData=function(){console.log(a.props);var e=a.props.tickets,t=a.props.bookingInfo,n=[];e.length!==parseInt(t.visitorsNumber,10)&&(console.log(e.length),console.log(t.visitorsNumber),n.push("You have "+t.visitorsNumber+" visitors but you only provided "+e.length+" tickets"));for(var r=0;r<e.length;r++){var o=e[r];o.firstName&&""!==o.firstName||n.push("Beneficiary #"+(r+1)+": Each visitor must have a first name"),o.lastName&&""!==o.lastName||n.push("Beneficiary #"+(r+1)+": Each visitor must have a last name"),o.birthDate||n.push("Beneficiary #"+(r+1)+": Each visitor must have a birth date"),o.country&&""!==o.country||n.push("Beneficiary #"+(r+1)+": Each visitor must have a country"),void 0===o.reduction&&n.push("Beneficiary #"+(r+1)+": For each visitor, please tell us if they are eligible for reduced price.")}return!(n.length>0)||(console.log("triggered"),console.log(n),a.setState({errors:n,showErrors:!0}),!1)},a.state={birthDate:new Date,showErrors:!1,errors:[]},a}return Object(m.a)(t,e),Object(l.a)(t,[{key:"render",value:function(){var e=this.props.bookingInfo.visitorsNumber?parseInt(this.props.bookingInfo.visitorsNumber,10):0;return console.log(e),r.a.createElement("div",{className:"step"},r.a.createElement("h2",null,e&&e>1?"Beneficiaries":"Beneficiary"),e>0?Object(B.a)(Array(e)).map(function(e,t){return r.a.createElement(U,{key:t,beneficiaryNumber:t+1,index:t})}):r.a.createElement(Y,{goToPrevious:this.props.previousStep}),r.a.createElement("div",{className:"form-group nav-line"},r.a.createElement("button",{className:"btn btn-secondary",onClick:this.onPreviousStepPress},"Previous"),r.a.createElement("button",{className:"btn btn-primary",onClick:this.onNextStepPress},"Recap")),r.a.createElement(M,{show:this.state.showErrors,onClose:this.onModalClose,errors:this.state.errors}))}}]),t}(r.a.Component),V=Object(h.b)(function(e){return e})(H),J=a(44),K=a(63),G=a.n(K),R=function(e){function t(e){var a;return Object(s.a)(this,t),(a=Object(c.a)(this,Object(u.a)(t).call(this,e))).onPreviousStepPress=function(){window.scrollTo(0,0),a.props.previousStep()},a.onNextStepPress=function(){var e={bookingInfo:a.props.bookingInfo,tickets:a.props.tickets};a.setState({isLoading:!0}),console.log(e),G.a.post("/order",e).then(function(t){console.log("Contenu de la r\xe9ponse depuis le serveur"),console.log(e),a.setState({isLoading:!1})}).catch(function(e){console.error("An error happened during the POST"),console.error(e),a.setState({isLoading:!1})})},a.calcPrice=function(e){var t=new Date(e.birthDate),n=a._calculateAge(t),r=e.reduction,o=a.props.bookingInfo.ticketType;return isNaN(n)||"half"!==o&&"full"!==o?0:n<4?0:n<12?"half"===o?4:8:n<60?r?"half"===o?5:10:"half"===o?8:16:n>=60?r?"half"===o?5:10:"half"===o?6:12:void 0},a._calculateAge=function(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:new Date,a=t.getFullYear(),n=t.getMonth(),r=t.getDate(),o=e.getFullYear(),i=e.getMonth(),s=e.getDate(),l=a-o,c=n-i;return(c<0||0===c&&r-s<0)&&(l=parseInt(l)-1),l},a.state={totalPrice:0},a}return Object(m.a)(t,e),Object(l.a)(t,[{key:"componentWillUpdate",value:function(){for(var e=this.props.tickets,t=0,a=0;a<e.length;a++){var n=e[a];t+=this.calcPrice(n)}t!==this.state.totalPrice&&this.setState({totalPrice:t})}},{key:"render",value:function(){var e=this;return r.a.createElement("div",{className:"step"},r.a.createElement("h2",{className:"step-title"},"Recap"),r.a.createElement("p",null,"You will find here all the recap of your order. Please be sure everything is ok before paying."),r.a.createElement("div",{className:"contained"},r.a.createElement("table",{className:"table"},r.a.createElement("thead",null,r.a.createElement("tr",null,r.a.createElement("th",{scope:"col"},"#"),r.a.createElement("th",{scope:"col"},"First Name"),r.a.createElement("th",{scope:"col"},"Last Name"),r.a.createElement("th",{scope:"col"},"Ticket type"),r.a.createElement("th",{scope:"col"},"Reduced Price"),r.a.createElement("th",{scope:"col"},"Cost"))),r.a.createElement("tbody",null,this.props.tickets.map(function(t,a){return r.a.createElement("tr",{key:a},r.a.createElement("th",{scope:"row"},a+1),r.a.createElement("td",null,t.firstName),r.a.createElement("td",null,t.lastName),r.a.createElement("td",null,"half"===e.props.bookingInfo.ticketType?"Half day":"Full day"),r.a.createElement("td",null,t.reduction?"yes":"no"),r.a.createElement("td",null,e.calcPrice(t)+" \u20ac"))}))),r.a.createElement("table",{className:"table"},r.a.createElement("thead",{className:"thead-light"},r.a.createElement("tr",null,r.a.createElement("th",{scope:"col"},"Number of tickets"),r.a.createElement("th",{scope:"col"},"Total Price (VAT included)"))),r.a.createElement("tbody",null,r.a.createElement("tr",null,r.a.createElement("th",null,this.props.tickets.length),r.a.createElement("td",null,this.state.totalPrice," \u20ac"))))),r.a.createElement("div",{className:"form-group nav-line"},r.a.createElement("button",{className:"btn btn-secondary",onClick:this.onPreviousStepPress},"Previous"),r.a.createElement("button",{className:"btn btn-primary",onClick:this.onNextStepPress},this.state.isLoading?r.a.createElement(J.Dots,{color:"white"}):"Order")))}}]),t}(r.a.Component),W=Object(h.b)(function(e){return e})(R),$=function(e){function t(e){var a;return Object(s.a)(this,t),(a=Object(c.a)(this,Object(u.a)(t).call(this,e))).onPreviousStepPress=function(){window.scrollTo(0,0),a.props.previousStep()},a.onNextStepPress=function(){window.scrollTo(0,0),a.props.nextStep()},a.state={isLoading:!1},a}return Object(m.a)(t,e),Object(l.a)(t,[{key:"render",value:function(){return r.a.createElement("div",{className:"step"},r.a.createElement("h2",{className:"step-title"},"Payment"),r.a.createElement("div",{className:"contained"},r.a.createElement("div",{className:"row"},r.a.createElement("div",{className:"col-md-6 mb-3"},r.a.createElement("label",null,"Name on card"),r.a.createElement("input",{type:"text",className:"form-control",id:"cc-name",placeholder:"Mr DOE John"}),r.a.createElement("small",{className:"text-muted"},"Full name as displayed on card"),r.a.createElement("div",{className:"invalid-feedback"},"Name on card is required")),r.a.createElement("div",{className:"col-md-6 mb-3"},r.a.createElement("label",null,"Credit card number"),r.a.createElement("input",{type:"text",className:"form-control",id:"cc-number",placeholder:"5676XXXXXXXXX"}),r.a.createElement("div",{className:"invalid-feedback"},"Credit card number is required"))),r.a.createElement("div",{className:"row"},r.a.createElement("div",{className:"col-md-3 mb-3"},r.a.createElement("label",null,"Expiration"),r.a.createElement("input",{type:"text",className:"form-control",id:"cc-expiration",placeholder:"MM/AA"}),r.a.createElement("div",{className:"invalid-feedback"},"Expiration date required")),r.a.createElement("div",{className:"col-md-3 mb-3"},r.a.createElement("label",null,"CVV"),r.a.createElement("input",{type:"text",className:"form-control",id:"cc-cvv",placeholder:"XXX"}),r.a.createElement("div",{className:"invalid-feedback"},"Security code required")))),r.a.createElement("div",{className:"form-group nav-line"},r.a.createElement("button",{style:{width:"100%"},className:"btn btn-primary",onClick:this.onNextStepPress},this.state.isLoading?r.a.createElement(J.Dots,{color:"white"}):"Pay")))}}]),t}(r.a.Component),z=function(e){function t(e){var a;return Object(s.a)(this,t),(a=Object(c.a)(this,Object(u.a)(t).call(this,e))).state={},a}return Object(m.a)(t,e),Object(l.a)(t,[{key:"render",value:function(){return r.a.createElement("div",{className:"step"},r.a.createElement("h2",{className:"step-title"},"Congratulations !"),r.a.createElement("p",{style:{textAlign:"justify"}},"Your order has been approved ! An email has been sent to ",r.a.createElement("b",null,this.props.bookingInfo.orderMailing)," with all your tickets. The Louvre Museum wishes you a good visit."))}}]),t}(r.a.Component),Q=Object(h.b)(function(e){return e})(z),Z=(a(93),function(e){function t(){return Object(s.a)(this,t),Object(c.a)(this,Object(u.a)(t).apply(this,arguments))}return Object(m.a)(t,e),Object(l.a)(t,[{key:"render",value:function(){return r.a.createElement(h.a,{store:E},r.a.createElement("div",{className:"App"},r.a.createElement(d.a,{className:"contained",isHashEnabled:!0},r.a.createElement(A,null),r.a.createElement(V,null),r.a.createElement(W,null),r.a.createElement($,null),r.a.createElement(Q,null))))}}]),t}(r.a.Component));Boolean("localhost"===window.location.hostname||"[::1]"===window.location.hostname||window.location.hostname.match(/^127(?:\.(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)){3}$/));i.a.render(r.a.createElement(Z,null),document.getElementById("root")),"serviceWorker"in navigator&&navigator.serviceWorker.ready.then(function(e){e.unregister()})}},[[68,1,2]]]);
//# sourceMappingURL=main.92c158d5.chunk.js.map