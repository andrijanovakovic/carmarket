{% extends 'templates/default.php' %}

{% block title %}Advert detail - {{ advert.car_manufacturer }} {{ advert.car_model }} {% endblock %}

{% block content %}

<div style="display: flex; flex-direction: column; width: 100%; align-items:center;">
    <div class="card" style="width: 70%">
        <div class="card-header">
            <div class="advert_detail_images_container">
                {% for image in advert.images %}
                <img src="data:image/jpg;base64, {{ image.val }}"
                    style="margin: 5px; height: 400px; width: 400px;border-radius:6px;  object-fit: cover;"
                    class="advert_detail_images_container_image" />
                {%endfor%}
            </div>
            <div
                style="display: flex; flex-direction: row;justify-content: space-between; align-items:center; margin-top: 10px">
                <div style="display: flex; flex-direction: column;">
                    <h5 style="margin: 0px; padding: 0px;">{{ advert.car_manufacturer }} {{ advert.car_model }} - &#8364
                        {{advert.car_price}}</h5>
                </div>
                {% if auth and auth.id is same as(advert.user_id) %}
                <a href="{{ urlFor('advert.edit', { advert_id: advert.id }) }}" class="btn btn-secondary"
                    style="margin-top: 20px;">This ad is yours. Click here to edit it!</a>
                {% endif %}
            </div>
        </div>
        <div class="card-body">
            <div style="margin-bottom: 15px; padding-bottom: 15px; border-bottom: 0.5px solid #08171f;">
                <h5 class="card-title">Car info</h5>
                <p>Manufacturer: {{ advert.car_manufacturer }}</p>
                <p>Model: {{ advert.car_model }}</p>
                <p>MY: {{ advert.car_make_year_and_month }}</p>
                <p>First registration date: {{ advert.car_first_registration_date }}</p>
                <p>Mileage: {{ advert.car_mileage }} km</p>
            </div>
            <div style="margin-bottom: 15px; padding-bottom: 15px; border-bottom: 0.5px solid #08171f;">
                <h5 class="card-title">Engine info</h5>
                <p>Fuel: {{ advert.engine_fuel }}</p>
                <p>Displacement: {{ advert.engine_displacement }} ccm</p>
                <p>Power: {{ advert.engine_power }} kW</p>
                <p>Transmission: {{ advert.engine_transmission }} gears</p>
            </div>
            <div style="margin-bottom: 15px; padding-bottom: 15px; border-bottom: 0.5px solid #08171f;">
                <h5 class="card-title">Body info</h5>
                <p>Color: {{ advert.body_color }}</p>
                <p>Door count: {{ advert.body_door_count }}</p>
            </div>
            <div
                style="margin-bottom: 15px; margin-bottom: 15px; padding-bottom: 15px; border-bottom: 0.5px solid #08171f;">
                <h5 class="card-title">Owner info</h5>
                <p>Name: {{ owner_info.first_name }} {{ owner_info.last_name }}</p>
                <p>GSM 1: {{ owner_info.gsm_number }}</p>
                <p>GSM 2: {{ owner_info.gsm_number_1 }}</p>
                <p>GSM 3: {{ owner_info.gsm_number_2 }}</p>
                <p>Phone 1: {{ owner_info.stationary_number }}</p>
                <p>Phone 2: {{ owner_info.stationary_number_1 }}</p>
                <p>Phone 3: {{ owner_info.stationary_number_2 }}</p>
                <p>E-mail: {{ owner_email.email }}</p>
                <p>Address: {{ owner_info.address }}, {{owner_info.zip}} {{ owner_info.city}}, {{owner_info.country}}
                </p>
            </div>
            <div
                style="margin-bottom: 15px; margin-bottom: 15px; padding-bottom: 15px; border-bottom: 0.5px solid #08171f;">
                <h5 class="card-title">Comments</h5>
                {% for comment in advert.comments %}
                    <div style="width: 100%; padding: 10px; background: #1c282e; border-radius: 5px; margin-bottom: 5px;">
                        <p>Nickname: {{ comment.nickname }}</p>
                        <p>Email: {{ comment.email }}</p>
                        <p>Comment: {{ comment.value }}</p>
                        <p>Created:  {{ comment.created_at|date('d/M/Y H:i:s') }}</p>
                        
                        {% if auth and auth.id is same as(advert.user_id) %}
                        <!-- remove comment form -->
                        <form id="remove_comment_form" name="remove_comment_form" class="first_login_form" action="{{ urlFor('comment.remove', { advert_id: advert.id, comment_id: comment.id })}}" method="post"
                            enctype="multipart/form-data">
                            <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 20px">Remove comment!</button>
                            <input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}" />
                        </form>
                        {% endif %}
                    </div>
                {% endfor %}
            </div>
            <!-- add comment form -->
            <form id="comment_form" name="comment_form" class="first_login_form" action="{{ urlFor('comment.add', { advert_id: advert.id })}}" method="post"
                enctype="multipart/form-data">
                <div
                    style="margin-bottom: 15px; margin-bottom: 15px; padding-bottom: 15px; border-bottom: 0.5px solid #08171f;">
                    <h5 class="card-title">Add comment</h5>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="comment_email">Email</label>
                            <input type="text" class="form-control" id="comment_email" name="comment_email" {% if auth.email %} value="{{auth.email}}" {% endif %} required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="comment_nickname">Nickname</label>
                            <input type="text" class="form-control" id="comment_nickname" name="comment_nickname" {% if current_user_info.first_name %} value="{{current_user_info.first_name}}" {% endif %} required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="comment_value">Comment</label>
                            <input type="text" class="form-control" id="comment_value" name="comment_value">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 20px">Add comment!</button>
                <input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}" />
            </form>
            
            <p>This advert has {{ advert.views }} views.</p>
        </div>
    </div>
</div>

{% endblock %}

{% block javascripts %}
<script type="text/javascript">
/*
$("#comment_form").submit(function(e) {
    // prevent form submit
    e.preventDefault();

    // get form data
    var form = new FormData(document.getElementById("comment_form"));
    var comment_email = form.get("comment_email");
    var comment_nickname = form.get("comment_nickname");
    var comment_value = form.get("comment_value");
    
    postAjax(`/asd/`, { p1: 1, p2: 'Hello World' }, function(data){ console.log(data); });
});
*/

function postAjax(url, data, success) {
    var params = typeof data == 'string' ? data : Object.keys(data).map(
            function(k){ return encodeURIComponent(k) + '=' + encodeURIComponent(data[k]) }
        ).join('&');

    var xhr = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
    xhr.open('POST', url);
    xhr.onreadystatechange = function() {
        if (xhr.readyState>3 && xhr.status==200) { success(xhr.responseText); }
    };
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send(params);
    return xhr;
}
</script>

{% endblock%}