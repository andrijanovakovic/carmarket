{% extends 'templates/default.php' %}

{% block title %}Advert detail - {{ advert.car_manufacturer }} {{ advert.car_model }} {% endblock %}

{% block content %}

<div style="display: flex; flex-direction: column; width: 100%; align-items:center;">
    <div class="card">
        <div class="card-header">
            <div class="advert_detail_images_container">
                {% for image in advert.images %}
                <img src="data:image/jpg;base64, {{ image.val }}" style="margin: 5px; height: 400px; width: 400px;border-radius:6px;  object-fit: cover;"
                    class="advert_detail_images_container_image" />
                {%endfor%}
            </div>
            <div style="display: flex; flex-direction: row;justify-content: space-between; align-items:center; margin-top: 10px">
                <div style="display: flex; flex-direction: column;">
                    <h5 style="margin: 0px; padding: 0px;">{{ advert.car_manufacturer }} {{ advert.car_model }} - &#8364 {{advert.car_price}}</h5>
                </div>
                {% if auth and auth.id is same as(advert.user_id) %}
                    <a href="{{ urlFor('advert.edit', { advert_id: advert.id }) }}" class="btn btn-secondary" style="margin-top: 20px;">This ad is yours. Click here to edit it!</a>
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
            <div style="margin-bottom: 15px">
                <h5 class="card-title">Owner info</h5>
                <p>Name: {{ owner_info.first_name }} {{ owner_info.last_name }}</p>
                <p>GSM 1: {{ owner_info.gsm_number }}</p>
                <p>GSM 2: {{ owner_info.gsm_number_1 }}</p>
                <p>GSM 3: {{ owner_info.gsm_number_2 }}</p>
                <p>Phone 1: {{ owner_info.stationary_number }}</p>
                <p>Phone 2: {{ owner_info.stationary_number_1 }}</p>
                <p>Phone 3: {{ owner_info.stationary_number_2 }}</p>
                <p>E-mail: {{ owner_email.email }}</p>
                <p>Address: {{ owner_info.address }}, {{owner_info.zip}} {{ owner_info.city}}, {{owner_info.country}}</p>
            </div>
            <p>This advert has {{ advert.views }} views.</p>
        </div>
    </div>
</div>

{% endblock %}