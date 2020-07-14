<?php defined( 'ABSPATH' ) || exit; // Exit if accessed directly ?>

<style type="text/css">
	.bdaia-modal-outer{display:table;position:fixed;top:0;left:0;width:100%;height:100%;opacity:0;background-color:rgba(0,0,0,.85);pointer-events:none;transform:scale(1.25);transition:transform .65s cubic-bezier(.23,1,.32,1),opacity .65s cubic-bezier(.23,1,.32,1);z-index:999999999}.bdaia-modal-outer.bdaia-active{opacity:1;pointer-events:auto;transform:scale(1)}.bdaia-modal-inner{display:table-cell;width:100%;height:100%;padding:7.5%;vertical-align:middle}.bdaia-confirm{max-width:650px;margin:0 auto;color:#000;background-color:#fff;box-shadow:0 0 35px rgba(0,0,0,.9)}.bdaia-confirm-text{margin:0;padding:25px;border-bottom:1px solid rgba(0,0,0,.1);font-size:18px;font-weight:600;line-height:1.5}.bdaia-confirm-actions{background:#F0F0F0;text-align:center;padding:15px 25px}.bdaia-confirm-actions .bdaia-btn{margin:0 .5em}.bdaia-btn,a.bdaia-btn,button.bdaia-btn,input[type=submit].bdaia-btn{display:inline-block;margin:0;border:0;padding:13px 20px;font-size:.85em;font-weight:600;line-height:1.2;text-decoration:none;text-transform:uppercase;color:#fff!important;background-color:#9e9e9e;border-radius:3px;transition:border-color .3s ease,background-color .3s ease;cursor:pointer}.bdaia-btn:active,.bdaia-btn:focus,.bdaia-btn:hover,a.bdaia-btn:active,a.bdaia-btn:focus,a.bdaia-btn:hover,button.bdaia-btn:active,button.bdaia-btn:focus,button.bdaia-btn:hover,input[type=submit].bdaia-btn:active,input[type=submit].bdaia-btn:focus,input[type=submit].bdaia-btn:hover{background-color:#ababab;-webkit-box-shadow:none;box-shadow:none;outline:0}.bdaia-btn.bdaia-btn-confirm,.bdaia-btn.bdaia-btn-confirm:active,.bdaia-btn.bdaia-btn-confirm:focus,.bdaia-btn.bdaia-btn-confirm:hover,a.bdaia-btn.bdaia-btn-confirm,a.bdaia-btn.bdaia-btn-confirm:active,a.bdaia-btn.bdaia-btn-confirm:focus,a.bdaia-btn.bdaia-btn-confirm:hover,button.bdaia-btn.bdaia-btn-confirm,button.bdaia-btn.bdaia-btn-confirm:active,button.bdaia-btn.bdaia-btn-confirm:focus,button.bdaia-btn.bdaia-btn-confirm:hover,input[type=submit].bdaia-btn.bdaia-btn-confirm,input[type=submit].bdaia-btn.bdaia-btn-confirm:active,input[type=submit].bdaia-btn.bdaia-btn-confirm:focus,input[type=submit].bdaia-btn.bdaia-btn-confirm:hover{background-color:#96C346}.bdaia-progress{position:relative;width:100%;max-width:500px;margin:0 auto;text-align:center;opacity:0;transition:all .65s cubic-bezier(.23,1,.32,1);transform:scale(.5);z-index:1}.bdaia-processing .bdaia-progress{opacity:1;transform:scale(1);z-index:2}.bdaia-processing .bdaia-progress-complete{opacity:0;transform:scale(.5);z-index:1}.bdaia-progress-title{width:100%;margin:25px 0 0;padding:0;font-size:24px;font-weight:600;line-height:1.3;color:#fff}.preloader-dotline .dot{display:inline-block;background:#EA4335;height:6px;width:6px;opacity:0;border-radius:50%;-moz-border-radius:50%;-webkit-border-radius:50%;animation:dotline-move 3s infinite;-moz-animation:dotline-move 3s infinite;-webkit-animation:dotline-move 3s infinite;transform:translateX(-144px);-moz-transform:translateX(-144px);-webkit-transform:translateX(-144px)}.preloader-dotline .dot:nth-child(1){animation-delay:.8s;-moz-animation-delay:.8s;-webkit-animation-delay:.8s}.preloader-dotline .dot:nth-child(2){animation-delay:.7s;-moz-animation-delay:.7s;-webkit-animation-delay:.7s}.preloader-dotline .dot:nth-child(3){animation-delay:.6s;-moz-animation-delay:.6s;-webkit-animation-delay:.6s}.preloader-dotline .dot:nth-child(4){animation-delay:.5s;-moz-animation-delay:.5s;-webkit-animation-delay:.5s}.preloader-dotline .dot:nth-child(5){animation-delay:.4s;-moz-animation-delay:.4s;-webkit-animation-delay:.4s}.preloader-dotline .dot:nth-child(6){animation-delay:.3s;-moz-animation-delay:.3s;-webkit-animation-delay:.3s}.preloader-dotline .dot:nth-child(7){animation-delay:.2s;-moz-animation-delay:.2s;-webkit-animation-delay:.2s}.preloader-dotline .dot:nth-child(8){animation-delay:.1s;-moz-animation-delay:.1s;-webkit-animation-delay:.1s}@keyframes dotline-move{40%{transform:translateX(0);-moz-transform:translateX(0);-webkit-transform:translateX(0);opacity:.8}100%{transform:translateX(144px);-moz-transform:translateX(144px);-webkit-transform:translateX(144px);opacity:0}}
	i.fa.fa-check-circle.bdaia-progress-title {margin-top: 5px;}.bdaia-progress table{width:100%;margin:40px auto auto;text-align:left}.bdaia-progress table td{padding:20px}.step_1,.step_2,.step_3{text-align:center;padding:20px}.remove .fa,.step_1 .fa,.step_2 .fa,.step_2 .uil-ring-css,.step_3 .fa,.step_3 .uil-ring-css{display:none}@-ms-keyframes uil-ring-anim{0%{-ms-transform:rotate(0);-moz-transform:rotate(0);-webkit-transform:rotate(0);-o-transform:rotate(0);transform:rotate(0)}100%{-ms-transform:rotate(360deg);-moz-transform:rotate(360deg);-webkit-transform:rotate(360deg);-o-transform:rotate(360deg);transform:rotate(360deg)}}@-moz-keyframes uil-ring-anim{0%{-ms-transform:rotate(0);-moz-transform:rotate(0);-webkit-transform:rotate(0);-o-transform:rotate(0);transform:rotate(0)}100%{-ms-transform:rotate(360deg);-moz-transform:rotate(360deg);-webkit-transform:rotate(360deg);-o-transform:rotate(360deg);transform:rotate(360deg)}}@-webkit-keyframes uil-ring-anim{0%{-ms-transform:rotate(0);-moz-transform:rotate(0);-webkit-transform:rotate(0);-o-transform:rotate(0);transform:rotate(0)}100%{-ms-transform:rotate(360deg);-moz-transform:rotate(360deg);-webkit-transform:rotate(360deg);-o-transform:rotate(360deg);transform:rotate(360deg)}}@-o-keyframes uil-ring-anim{0%{-ms-transform:rotate(0);-moz-transform:rotate(0);-webkit-transform:rotate(0);-o-transform:rotate(0);transform:rotate(0)}100%{-ms-transform:rotate(360deg);-moz-transform:rotate(360deg);-webkit-transform:rotate(360deg);-o-transform:rotate(360deg);transform:rotate(360deg)}}@keyframes uil-ring-anim{0%{-ms-transform:rotate(0);-moz-transform:rotate(0);-webkit-transform:rotate(0);-o-transform:rotate(0);transform:rotate(0)}100%{-ms-transform:rotate(360deg);-moz-transform:rotate(360deg);-webkit-transform:rotate(360deg);-o-transform:rotate(360deg);transform:rotate(360deg)}}.uil-ring-css{background:0 0;position:relative}.uil-ring-css>div{position:absolute;display:block;width:80px;height:80px;top:0;left:0;border-radius:80px;box-shadow:0 6px 0 0 #fff;-ms-animation:uil-ring-anim 1s linear infinite;-moz-animation:uil-ring-anim 1s linear infinite;-webkit-animation:uil-ring-anim 1s linear infinite;-o-animation:uil-ring-anim 1s linear infinite;animation:uil-ring-anim 1s linear infinite}
</style>

<div class="bdaia-modal-outer install">
	<div class="bdaia-modal-inner">

		<!--/START Confirm/-->
		<div class="bdaia-confirm">
			<div class="bdaia-confirm-text">
				Are you sure? This will import our predefined settings for the demo Background, template layouts, fonts, colors etc... and our sample content.
				<br>
				<br>
				Please backup your settings to be sure that you don't lose them by accident.
			</div>
			<div class="bdaia-confirm-actions">
				<button class="bdaia-btn bdaia-btn-confirm">Yes, Proceed</button>
				<button class="bdaia-btn bdaia-btn-cancel">No, Take me back</button>
			</div>
		</div>
		<!--/END Confirm/-->

		<!--/START Progress/-->
		<div class="bdaia-progress">
			<div class="">
				<div class='preloader-dotline'>
					<div class='dot'></div>
					<div class='dot'></div>
					<div class='dot'></div>
					<div class='dot'></div>
					<div class='dot'></div>
					<div class='dot'></div>
					<div class='dot'></div>
					<div class='dot'></div>
				</div>
				<div class="bdaia-progress-title processing">
					Processing ...
				</div>
				<div class="bdaia-progress">
					<table>
						<tr>
							<td width="80%" class="bdaia-progress-title">Importing demo content</td>
							<td class="step_1">
								<div class='uil-ring-css' style='transform:scale(0.2);'><div></div></div>
								<i class="fa fa-check-circle bdaia-progress-title"></i>
							</td>
						</tr>
						<tr>
							<td width="80%" class="bdaia-progress-title">Importing demo options</td>
							<td class="step_2">
								<div class='uil-ring-css' style='transform:scale(0.2);'><div></div></div>
								<i class="fa fa-check-circle bdaia-progress-title"></i>
							</td>
						</tr>
						<tr>
							<td width="80%" class="bdaia-progress-title">Applying demo settings</td>
							<td class="step_3">
								<div class='uil-ring-css' style='transform:scale(0.2);'><div></div></div>
								<i class="fa fa-check-circle bdaia-progress-title"></i>
							</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
		<!--/END Progress/-->

	</div>
</div>

<div class="bdaia-modal-outer uninstall">
	<div class="bdaia-modal-inner">

		<!--/START Confirm/-->
		<div class="bdaia-confirm">
			<div class="bdaia-confirm-text">
				Are you sure? This will remove all the imported settings for the demo Background, template layouts, fonts, colors etc... and our sample content.
				<br>
				<br>
				Please backup your settings to be sure that you don't lose them by accident.
			</div>
			<div class="bdaia-confirm-actions">
				<button class="bdaia-btn bdaia-btn-confirm" style="background-color:red">Yes, Proceed</button>
				<button class="bdaia-btn bdaia-btn-cancel">No, Take me back</button>
			</div>
		</div>
		<!--/END Confirm/-->

		<!--/START Progress/-->
		<div class="bdaia-progress">
			<div class="">
				<div class='preloader-dotline'>
					<div class='dot'></div>
					<div class='dot'></div>
					<div class='dot'></div>
					<div class='dot'></div>
					<div class='dot'></div>
					<div class='dot'></div>
					<div class='dot'></div>
					<div class='dot'></div>
				</div>
				<div class="bdaia-progress-title processing">
					Processing ...
				</div>
				<div class="bdaia-progress">
					<table>
						<tr>
							<td width="80%" class="bdaia-progress-title">Removing demo</td>
							<td class="remove">
								<div class='uil-ring-css' style='transform:scale(0.2);'><div></div></div>
								<i class="fa fa-check-circle bdaia-progress-title"></i>
							</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
		<!--/END Progress/-->

	</div>
</div>