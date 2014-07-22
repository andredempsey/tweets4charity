@extends('layouts.master')

@section('content')

<button class="btn btn-success btn-ajax">Click Me!</button>
<div id="ajax-message"></div>

<form id="ajax-form">
Baby Id: <input type="text" name="baby_id"><br>
Baby Name: <input type="text" name="baby_name"><br>
<input type="submit">
</form>

@stop

@section('bottomscript')
<script>

// drag and drop table to update budget
// 
// star rating system
// 
// usage with timers
// 
// grab a new job
// 
$('#ajax-form').on('submit', function (e) {
    e.preventDefault();
    var formValues = $(this).serialize();
    console.log(formValues);

    $.ajax({
        url: "/ajax",
        type: "POST",
        data: formValues,
        dataType: "json",
        success: function (data) {
            $('#ajax-message').html(data.message);
        }
    });
});

$('.btn-ajax').on('click', function () {

    console.log('Clicked the button');

    var toSend = {
        'id': 1,
        'name': 'test'
    };

    $.ajax({
        url: "/ajax",
        type: "POST",
        data: toSend,
        dataType: "json",
        success: function (data) {
            $('#ajax-message').html(data.message);
        }
    });

});


</script>
@stop