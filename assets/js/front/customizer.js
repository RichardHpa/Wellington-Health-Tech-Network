;(function () {
	wp.customize.bind('ready', function () {
		for (var i = 1; i <= 10; i++) {
			$(`#customize-control-whtn_slide_${i}_control`).hide();
			if(i <= post_counts['count']){
				$(`#customize-control-whtn_slide_${i}_control`).show();
			}
		}
        // include the id you use when you create the control
		wp.customize.control('whtn_slide_count_control', function (control) {
			control.setting.transport = 'refresh';
		// 	/**
		// 	 * Run function on setting change of control.
		// 	 */
			control.setting.bind(function (value) {
                for (var i = 1; i <= 10; i++) {
                    $(`#customize-control-whtn_slide_${i}_control`).hide();
                    if(i <= value){
                        $(`#customize-control-whtn_slide_${i}_control`).show();
                    }
                }

			});
		});

		wp.customize.control('whtn_notification_display_control', function (control) {
			control.setting.transport = 'refresh';
			control.setting.bind(function (value) {
				if(value === 'yes'){
					$('#customize-control-whtn_notification_title_control').show();
					$('#customize-control-whtn_notification_description_control').show();
					$('#customize-control-whtn_notification_link_control').show();
				} else {
					$('#customize-control-whtn_notification_title_control').hide();
					$('#customize-control-whtn_notification_description_control').hide();
					$('#customize-control-whtn_notification_link_control').hide();
				}
			});
		});
	});
})();
