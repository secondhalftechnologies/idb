<style type="text/css">
.controls-row {
*zoom:1
}
.controls-row:before, .controls-row:after {
	display: table;
	line-height: 0;
	content: ""
}
.controls-row:after {
	clear: both
}
.controls-row [class*="span"], .row-fluid .controls-row [class*="span"] {
	float: left
}
.controls-row .checkbox[class*="span"], .controls-row .radio[class*="span"] {
	padding-top: 5px
}
input[disabled], select[disabled], textarea[disabled], input[readonly], select[readonly], textarea[readonly] {
	cursor: not-allowed;
	background-color: #eee
}
input[type="radio"][disabled], input[type="checkbox"][disabled], input[type="radio"][readonly], input[type="checkbox"][readonly] {
	background-color: transparent
}
.control-group.warning .control-label, .control-group.warning .help-block, .control-group.warning .help-inline {
	color: #c09853
}
.control-group.warning .checkbox, .control-group.warning .radio, .control-group.warning input, .control-group.warning select, .control-group.warning textarea {
	color: #c09853
}
.control-group.warning input, .control-group.warning select, .control-group.warning textarea {
	border-color: #c09853;
	-webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,0.075);
	-moz-box-shadow: inset 0 1px 1px rgba(0,0,0,0.075);
	box-shadow: inset 0 1px 1px rgba(0,0,0,0.075)
}
.control-group.warning input:focus, .control-group.warning select:focus, .control-group.warning textarea:focus {
	border-color: #a47e3c;
	-webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,0.075), 0 0 6px #dbc59e;
	-moz-box-shadow: inset 0 1px 1px rgba(0,0,0,0.075), 0 0 6px #dbc59e;
	box-shadow: inset 0 1px 1px rgba(0,0,0,0.075), 0 0 6px #dbc59e
}
.control-group.warning .input-prepend .add-on, .control-group.warning .input-append .add-on {
	color: #c09853;
	background-color: #fcf8e3;
	border-color: #c09853
}
.control-group.error .control-label, .control-group.error .help-block, .control-group.error .help-inline {
	color: #b94a48
}
.control-group.error .checkbox, .control-group.error .radio, .control-group.error input, .control-group.error select, .control-group.error textarea {
	color: #b94a48
}
.control-group.error input, .control-group.error select, .control-group.error textarea {
	 border: 1px solid #b94a48;
	/*-webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,0.075);
	-moz-box-shadow: inset 0 1px 1px rgba(0,0,0,0.075);
	box-shadow: inset 0 1px 1px rgba(0,0,0,0.075)*/
}
.control-group.error input:focus, .control-group.error select:focus, .control-group.error textarea:focus {
	border-color: #953b39;
	-webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,0.075), 0 0 6px #d59392;
	-moz-box-shadow: inset 0 1px 1px rgba(0,0,0,0.075), 0 0 6px #d59392;
	box-shadow: inset 0 1px 1px rgba(0,0,0,0.075), 0 0 6px #d59392
}
.control-group.error .input-prepend .add-on, .control-group.error .input-append .add-on {
	color: #b94a48;
	background-color: #f2dede;
	border-color: #b94a48
}
.control-group.success .control-label, .control-group.success .help-block, .control-group.success .help-inline {
	color: #468847
}
.control-group.success .checkbox, .control-group.success .radio, .control-group.success input, .control-group.success select, .control-group.success textarea {
	color: #468847
}
.control-group.success input, .control-group.success select, .control-group.success textarea {
	border-color: #468847;
	-webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,0.075);
	-moz-box-shadow: inset 0 1px 1px rgba(0,0,0,0.075);
	box-shadow: inset 0 1px 1px rgba(0,0,0,0.075)
}
.control-group.success input:focus, .control-group.success select:focus, .control-group.success textarea:focus {
	border-color: #356635;
	-webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,0.075), 0 0 6px #7aba7b;
	-moz-box-shadow: inset 0 1px 1px rgba(0,0,0,0.075), 0 0 6px #7aba7b;
	box-shadow: inset 0 1px 1px rgba(0,0,0,0.075), 0 0 6px #7aba7b
}
.control-group.success .input-prepend .add-on, .control-group.success .input-append .add-on {
	color: #468847;
	background-color: #dff0d8;
	border-color: #468847
}
.control-group.info .control-label, .control-group.info .help-block, .control-group.info .help-inline {
	color: #3a87ad
}
.control-group.info .checkbox, .control-group.info .radio, .control-group.info input, .control-group.info select, .control-group.info textarea {
	color: #3a87ad
}
.control-group.info input, .control-group.info select, .control-group.info textarea {
	border-color: #3a87ad;
	-webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,0.075);
	-moz-box-shadow: inset 0 1px 1px rgba(0,0,0,0.075);
	box-shadow: inset 0 1px 1px rgba(0,0,0,0.075)
}
.control-group.info input:focus, .control-group.info select:focus, .control-group.info textarea:focus {
	border-color: #2d6987;
	-webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,0.075), 0 0 6px #7ab5d3;
	-moz-box-shadow: inset 0 1px 1px rgba(0,0,0,0.075), 0 0 6px #7ab5d3;
	box-shadow: inset 0 1px 1px rgba(0,0,0,0.075), 0 0 6px #7ab5d3
}
.control-group.info .input-prepend .add-on, .control-group.info .input-append .add-on {
	color: #3a87ad;
	background-color: #d9edf7;
	border-color: #3a87ad
}
input:focus:invalid, textarea:focus:invalid, select:focus:invalid {
color:#b94a48;
border-color:#ee5f5b
}
input:focus:invalid:focus, textarea:focus:invalid:focus, select:focus:invalid:focus {
border-color:#e9322d;
-webkit-box-shadow:0 0 6px #f8b9b7;
-moz-box-shadow:0 0 6px #f8b9b7;
box-shadow:0 0 6px #f8b9b7
}

</style>