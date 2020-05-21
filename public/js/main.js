// Utility
if ( typeof Object.create !== 'function' ) {
	Object.create = function( obj ) {
		function F() {};
		F.prototype = obj;
		return new F();
	};
}

(function( $ ) {
	$.fn.sweetalert = function( result ){
		if( result.alert === false ){
			return false;
		}

		if( result.status != 200 ){
			Swal.fire({
				icon: result.type,
				title: result.title,
				text: result.text
			});
		}
		else{
			Swal.fire({
				icon: result.type,
				title: result.title,
				text: result.text,
				showConfirmButton: false,
				timer: result.timer || 1500
			});
		}
	};

	$.fn.sweetdelete = function( res ){
		const swalWithBootstrapButtons = Swal.mixin({
			customClass: {
				confirmButton: 'btn btn-danger m-1',
				cancelButton: 'btn btn-info m-1'
			},
			buttonsStyling: false
		})

		swalWithBootstrapButtons.fire({
			title: res.data('title'),
			text: res.data('text'),
			icon: 'warning',
			showCancelButton: true,
			confirmButtonText: 'ยืนยัน',
			cancelButtonText: 'ยกเลิก',
			reverseButtons: true
		}).then((result) => {
			if (result.value) {

				$.fn.deletedata( res );

			} else if (
				/* Read more about handling dismissals below */
				result.dismiss === Swal.DismissReason.cancel
				) {
				swalWithBootstrapButtons.fire({
					title:'ยกเลิกการดำเนินการ',
					icon:'error',
					showConfirmButton: false,
					timer: result.timer || 1500
				})
			}
		})
	};

	$.fn.showError = function( error ){
		$.each( error, function(field, message) {
			$.fn.showErrorMsg( field, message );
		});
	};

	$.fn.showErrorMsg = function( field,msg ){
		var input = $('form.form-submit').find('[name='+field+']');
		var div = input.closest("div")
		input.addClass('is-invalid');
		div.find('.invalid-feedback').text( msg );
	};

	$.fn.formData = function(form) {
		return form.serializeArray();
	};

	$.fn.inlineSubmit = function($form, formData, dataType) {
		var self = this;
		var dataType = dataType || 'json';

		if( !formData ){
			var formData = new FormData();

			$.each( $.fn.formData($form), function (index, field) {
				formData.append(field.name, field.value);
			});

			$.each( $form.find('input[type=file]'), function (index, field) {
				var files = $(this)[0].files;
				if( files.length>0 ){
					$.each( $(this)[0].files, function(i, file) {
						formData.append(field.name, file);
					});
				}
			});
		}

		$.ajax({
			url: $form.attr('action'),
			type: 'POST',
			data: formData,
			dataType: dataType,
			processData: false, // Don't process the files
        	contentType: false, // Set content type to false as jQuery will tell the server its a query string request
        	success : function( res ) {
        		$.fn.processForm( res );
        	},
        	error : function() {
        		$.fn.sweetalert( {type:"error", title:"เกิดข้อผิดพลาด...", "timer":2000} );
        	}
        });
		// .fail(function() {
		// 	$.fn.sweetalert( {type:"error", title:"เกิดข้อผิดพลาด...", "timer":2000} );
		// })
		// .always(function( result ) {
		// 	$.fn.processForm( result );
		// });
	};

	$.fn.processForm = function( res ){
		if( !res.error ){
			$.fn.sweetalert( res );
			if( res.status != 200 ){
				return false;
			}

			res.timer = res.timer || 1500;
			res.timer += 100;

			if( res.url == 'refresh' ){
				res.url = window.location.href;
			}

			setTimeout(function(){
				window.location = res.url;
			}, res.timer);
		}
		else{
			res.alert = res.alert || false;
			$.fn.showError( res.error );
			$.fn.sweetalert( res );
			$('.btn-submit').effect("shake",{distance:10,times:3});
		}
	};

	$.fn.deletedata = function( result, dataType ){
		var dataType = dataType || 'json';

		$.ajax({
			url: result.attr('href'),
			type: 'GET',
			dataType: dataType,
			processData: false, // Don't process the files
        	contentType: false, // Set content type to false as jQuery will tell the server its a query string request
        	success : function( res ) {
        		$.fn.processForm( res );
        	},
        	error : function() {
        		$.fn.sweetalert( {type:"error", title:"เกิดข้อผิดพลาด...", "timer":2000} );
        	}
        });
	}
})( jQuery );

//Event//
$('body').delegate('form.form-submit','submit',function(e){
	var $form = $(this);
	e.preventDefault();
	$.fn.inlineSubmit( $form );
});

$("form.form-submit").find("input").change(function(){
	var input = $(this);
	var div = input.closest("div");
	input.removeClass('is-invalid');
	div.find('.invalid-feedback').empty();
});

$('body').delegate('a.btn-delete', 'click', function(e) {
	$.fn.sweetdelete( $(this) );
	return false;
});