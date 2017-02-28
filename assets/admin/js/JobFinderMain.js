/**
 * Created by Kate on 026 26.02.17.
 */
jQuery(function($) {
    $(document).ready(function(){

    });
    // Отслежываем нажатие  на кнопку Add (<button class="step-by-steb-btn-add" >'.__('Add', STEPBYSTEP_PlUGIN_TEXTDOMAIN ).'</button> )
    $(document).find('.button-ajax').click(function (e) {
        var city, keywords, nosalary, salary, data;
        // Получаем данные формы
        city = $(document).find('.job-finder-ajax-city').val();
        keywords = $(document).find('.job-finder-ajax-keywords').val();
        nosalary = $(document).find('.job-finder-ajax-nosalary').val();
        salary = $(document).find('.job-finder-ajax-salary').val();
        // Формируем обьект данных который получит AJAX  обработчик
        data = {
            action: 'vacancies',
            city: city,
            keywords: keywords,
            nosalary: nosalary,
            salary: salary
        }
        // Вывод данных в консоль браузера
        console.log(data);
        console.log(ajaxurl+ '?action=vacancies');

        // Отправка данных ajax обработчику (wp_ajax_guest_book, wp_ajax_nopriv_guest_book)
        $.post( ajaxurl, data, function(response) {
            $( "#job-finder-vacancies ul").empty();
            jQuery.each( response.data, function( i, val ) {
                $("#job-finder-vacancies ul").append('<li><hr></li>');
                $("#job-finder-vacancies ul").append('<li><h3>'+val.name+'</h3></li>');
                $("#job-finder-vacancies ul").append('<li><p>'+val.companyName+'</p></li>');
                $("#job-finder-vacancies ul").append('<li><p>'+val.contactPerson+'</p></li>');
                $("#job-finder-vacancies ul").append('<li><p>'+val.contactPhone+'</p></li>');
            });

            console.log(response);
        });

        // Запрещаем отправление формы что бы страница не перезагружалась
        return false;
    });
});