{% extends 'templates/default.php' %}

{% block title %}Home{% endblock %}

{% block content %}

{% if adverts is empty %}
<div class="card" style="width: 70%; display: block;">
    <div class="card-header">
        Still nothing...
    </div>
    <div class="card-body">
        There are no ads in our database currently.
    </div>
</div>
{% else %}
<div style="display: flex; flex-direction: column; width: 100%; align-items:center;">
    {% for advert in adverts %}
    <div class="card advert" style="width: 70%;margin-bottom: 10px;">
        <div class="card-header">
            ({{ advert.car_make_year_and_month}}) {{advert.car_manufacturer}} {{ advert.car_model }}
        </div>
        <div class="card-body" style="display: flex; flex-direction:row">
        <div style="max-width: 200px; margin-right: 15px">
            <img src="data:image/jpg;base64, {{ advert.profile_image }}" class="home_car_advert_profile_img" />
            </div>
            <div>
                <p>First registration: {{advert.car_first_registration_date}}</p>
                <p>Mileage: {{advert.car_mileage}}km</p>
                <p>Price: &#8364 {{advert.car_price}}</p>
                <p>Displacement: {{advert.engine_displacement}}l</p>
                <p>Power: {{advert.engine_power}} kW</p>
            </div>
        </div>
    </div>
    {% endfor %}
</div>
{% endif %}

{% endblock %}