
function filter(link) {
	var filterValue = '';
	$('#filter .filter-field').each(function(id, filterField) {
		var type = $(filterField).data('type');
		switch (type) {
			case "range":
				var key = $(filterField).data('name');
				var input_min = $(filterField).find('input[name="min"]').val();
				var input_max = $(filterField).find('input[name="max"]').val();

				if(input_min || input_max) {
					filterValue += key + "/" + input_min + "-" + input_max + "/";
				}
				break;
			case "select-checkbox-weekdays":
				var key = $(filterField).data('name');
				var data = [];
				$(filterField).find('input[type="checkbox"]').each(function(key, val) {
					if($(val).is(':checked')) {
						data.push( $(val).val() );
					}
				});

				if(data.length) {
					filterValue += key + "/" + data.join('-')  + "/";
				}

				break;
			case "select":
				var select = $(filterField).find('select');

				if($(select).val()) {
					filterValue += $(select).attr('name') + "/" + $(select).val() + "/";
				}

				break;
			default: // number, text
				var input = $(filterField).find('input');
				if($(input).val()) {
					filterValue += $(input).attr('name') + "/" + $(input).val() + "/";
				}
				break;
		}
	});
	location.href = link + filterValue;
}