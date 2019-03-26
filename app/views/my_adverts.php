{% extends 'templates/default.php' %}

{% block title %}My adverts{% endblock %}

{% block content %}

{% if adverts is empty %}
<div class="card" style="width: 70%; display: block;">
    <div class="card-header">
        No ads :(
    </div>
    <div class="card-body">
        Click <a href="{{ urlFor('create_advert') }}" class="btn btn-primary">here</a> to create your ad :)
    </div>
</div>
{% else %}
<div style="display: flex; flex-direction: column; width: 100%; align-items:center;">
    {% for advert in adverts %}

    <a href="{{ urlFor('advert.detail', { advert_id: advert.id }) }}" class="card advert"
        style="width: 70%;margin-bottom: 10px; text-decoration: none;">
        <div>
            <div class="card-header" style="display: flex; flex-direction:row; justify-content: space-between;">
                <p style=" text-align:left"> ({{ advert.car_make_year_and_month}})
                    <b>{{advert.car_manufacturer}} {{ advert.car_model }}</b></p>
                <p style="text-align:right"><b>&#8364 {{advert.car_price}}&nbsp&nbsp</b>Posted:
                    {{ advert.created_at|date('d/M/Y H:i:s') }}, Viewed: {{advert.views}} times</p>
                {% if advert.expired %}
                    <b>This ad has expired on: {{ advert.expires|date('d/M/Y H:i:s') }}</b>
                {% endif %}
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
</div>
{% endif %}

{% endblock %}