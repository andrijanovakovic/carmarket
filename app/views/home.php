{% extends 'templates/default.php' %}

{% block title %}Home{% endblock %}

{% block content %}

{% if all_ads_count == 0 %}
<div class="card" style="width: 70%; display: block;">
    <div class="card-header">
        Still nothing...
    </div>
    <div class="card-body">
        There are no ads in our database currently.
    </div>
</div>
{% endif %}

{% if active_ads_count == 0 and all_ads_count != 0 %}
<div class="card" style="width: 70%; display: block;">
    <div class="card-header">
        We don't have active ads currently...
    </div>
    <div class="card-body">
        You just have to wait for someone to post, or post it yourself :)
        <p>Number of adverts in our database: {{ all_ads_count }}</p>
        <p>Number of active adverts in our database: {{ active_ads_count }}</p>
        <p>Number of inactive adverts in our database: {{ inactive_ads_count }}</p>
    </div>
</div>
{% endif %}

{% if active_ads_count > 0 %}
<div style="display: flex; flex-direction: column; width: 100%; align-items:center;">
    {% for advert in adverts %}
    <a href="{{ urlFor('advert.detail', { advert_id: advert.id }) }}" class="card advert"
        style="width: 70%;margin-bottom: 10px; text-decoration: none;">
        <div>
            <div class="card-header" style="display: flex; flex-direction:row; justify-content: space-between;">
                <p style=" text-align:left"> ({{ advert.car_make_year_and_month}})
                    <b>{{advert.car_manufacturer}} {{ advert.car_model }}</b></p>
                <p style="text-align:right"><b>&#8364 {{advert.car_price}}&nbsp&nbsp</b>Posted:
                    {{ advert.created_at|date('d/M/Y') }}, Viewed: {{advert.views}} times</p>
            </div>
            <div class="card-body" style="display: flex; flex-direction:row">
                <div style="max-width: 200px; margin-right: 15px">
                    <img src="data:image/jpg;base64, {{ advert.profile_image }}" class="home_car_advert_profile_img" />
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-sm">
                            <p>Manufacturer: {{ advert.car_manufacturer }}</p>
                            <p>Model: {{ advert.car_model }}</p>
                            <p>MY: {{ advert.car_make_year_and_month }}</p>
                        </div>
                        <div class="col-sm">
                            <p>Fuel: {{ advert.engine_fuel }}</p>
                            <p>Displacement: {{ advert.engine_displacement }} ccm</p>
                            <p>Power: {{ advert.engine_power }} kW</p>
                        </div>
                        <div class="col-sm">
                            <p>Color: {{ advert.body_color }}</p>
                            <p>Doors: {{ advert.body_door_count }}</p>
                            <p>Description: {{ advert.description|length > 32 ? advert.description|slice(0, 32) ~ '...' : advert.description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </a>
    {% endfor %}
    <div class="card advert" style="width: 70%; margin-top:30px">
        <div class="card-header" style="display: flex; flex-direction:row; justify-content: space-between;">
            <p style=" text-align:left">Stats</p>
        </div>
        <div class="card-body" style="display: flex; flex-direction:column">
            <p>Number of adverts in our database: {{ all_ads_count }}</p>
            <p>Number of active adverts in our database: {{ active_ads_count }}</p>
            <p>Number of inactive adverts in our database: {{ inactive_ads_count }}</p>
        </div>
    </div>
</div>
{% endif %}

{% endblock %}