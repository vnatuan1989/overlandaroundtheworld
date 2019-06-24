const init_prevent_save_form = function () {
/* TODO : remove file
	const $ = jQuery

	const execute = () => {

		let warning = false;
		$(document).on({
			change: () => warning = true,
			keyup: () => warning = true
		}, "input[type='text'], select, textarea, input[type='checkbox']")

		$("input[type='submit']").on("click", (e) => {
			warning = false
		})

		window.onbeforeunload = function () {
			if (warning) {
				return "You have made changes on this page that you have not yet confirmed. If you navigate away from this page you will lose your unsaved changes";
			}
		}

	}

	document.addEventListener('DOMContentLoaded', () => {
		execute();
	})
*/
}

export default init_prevent_save_form;

