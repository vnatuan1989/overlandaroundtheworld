const init_admin_button_preview = function () {
	const $ = jQuery

	const execute = () => {

		$("#api_key").blur(function() {
			var key = $(this).val();
			if( key.length === 0){
                $(".weglot-keyres").remove();
                $("#api_key").after('<span class="weglot-keyres weglot-nokkey"></span>');
                $("#wrap-weglot #submit").prop("disabled", true);
				return;
			}
			$.getJSON(
				"https://weglot.com/api/user-info?api_key=" + key,
				(data) => {
					$(".weglot-keyres").remove();
					$("#api_key").after(
						'<span class="weglot-keyres weglot-okkey"></span>'
					);
					$("#wrap-weglot #submit").prop(
						"disabled",
						false
					);

					const evt = new CustomEvent("weglotCheckApi", {
						detail: data
					});

					window.dispatchEvent(evt);
				}
			).fail(function() {
				$(".weglot-keyres").remove();
				$("#api_key").after('<span class="weglot-keyres weglot-nokkey"></span>');
				$("#wrap-weglot #submit").prop("disabled", true);
			});
		});
	}

	document.addEventListener('DOMContentLoaded', () => {
		execute();
	})
}

export default init_admin_button_preview;

