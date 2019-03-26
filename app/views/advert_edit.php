{% extends 'templates/default.php' %}

{% block title %}Advert edit - {{ advert.car_make_year }} {{ advert.car_manufacturer }} {{ advert.car_model }}{% endblock %}

{% block content %}

<div class="card" style="width: 70%">
    <div class="card-header">
        Advert Edit
    </div>
    <div class="card-body">
        <form id="form" name="form" class="first_login_form" action="{{ urlFor('advert.edit.post', { advert_id: advert.id })}}" method="post"
            enctype="multipart/form-data">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="car_manufacturer">Manufacturer</label>
                    <input type="text" class="form-control" id="car_manufacturer" name="car_manufacturer" {% if advert.car_manufacturer %} value="{{ advert.car_manufacturer }}" {% endif %}>
                </div>

                <div class="form-group col-md-6">
                    <label for="car_model">Model</label>
                    <input type="text" class="form-control" id="car_model" name="car_model" {% if advert.car_model %} value="{{ advert.car_model }}" {% endif %}>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="make_year">Make year</label>
                    <input type="number" class="form-control" id="make_year" name="make_year" {% if advert.car_make_year %} value="{{ advert.car_make_year }}" {% endif %}>
                </div>
                <div class="form-group col-md-3">
                    <label for="make_month">Make month</label>
                    <input type="number" class="form-control" id="make_month" name="make_month" {% if advert.car_make_month %} value="{{ advert.car_make_month  }}" {% endif %}>
                </div>
                <div class="form-group col-md-3">
                    <label for="first_reg_year">First registration year</label>
                    <input type="number" class="form-control" id="first_reg_year" name="first_reg_year" {% if advert.car_first_registration_year %} value="{{ advert.car_first_registration_year  }}" {% endif %}>
                </div>
                <div class="form-group col-md-3">
                    <label for="first_reg_month">First registration month</label>
                    <input type="number" class="form-control" id="first_reg_month" name="first_reg_month" {% if advert.car_first_registration_month %} value="{{ advert.car_first_registration_month  }}" {% endif %}>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="car_mileage">Mileage (KM)</label>
                    <input type="number" class="form-control" id="car_mileage" name="car_mileage" {% if advert.car_mileage %} value="{{ advert.car_mileage  }}" {% endif %}>
                </div>
                <div class="form-group col-md-6">
                    <label for="car_price">Price</label>
                    <input type="number" class="form-control" id="car_price" name="car_price" {% if advert.car_price %} value="{{ advert.car_price  }}" {% endif %}>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="engine_fuel">Fuel</label>
                    <input type="text" class="form-control" id="engine_fuel" name="engine_fuel" {% if advert.engine_fuel %} value="{{ advert.engine_fuel }}" {% endif %}>
                </div>
                <div class="form-group col-md-3">
                    <label for="engine_displacement">Displacement</label>
                    <input type="number" class="form-control" id="engine_displacement" name="engine_displacement" {% if advert.engine_displacement %} value="{{ advert.engine_displacement }}" {% endif %}>
                </div>
                <div class="form-group col-md-3">
                    <label for="engine_power">Power (kW)</label>
                    <input type="text" class="form-control" id="engine_power" name="engine_power" {% if advert.engine_power %} value="{{ advert.engine_power }}" {% endif %}>
                </div>
                <div class="form-group col-md-3">
                    <label for="engine_transmission">Transmission</label>
                    <input type="number" class="form-control" id="engine_transmission" name="engine_transmission" {% if advert.engine_transmission %} value="{{ advert.engine_transmission }}" {% endif %}>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="body_color">Color</label>
                    <input type="text" class="form-control" id="body_color" name="body_color" {% if advert.body_color %} value="{{ advert.body_color }}" {% endif %}>
                </div>
                <div class="form-group col-md-6">
                    <label for="body_door_count">Door count</label>
                    <input type="number" class="form-control" id="body_door_count" name="body_door_count" {% if advert.body_door_count %} value="{{ advert.body_door_count }}" {% endif %}>
                </div>
            </div>


            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control" rows="5">{{ advert.description }}</textarea>
                </div>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 20px">Finish editing</button>
            <input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}" />
        </form>
        
        <p style="margin-top:50px; font-size:18px; font-weight: bold;">If you want to delete your ad, click below.</p>
        <form action="{{ urlFor('advert_delete', { advert_id: advert.id }) }}" method="post">
            <button type="submit" class="btn btn-danger" style="width: 100%; margin-top: 20px">Delete</button>
            <input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}" />
        </form>
    </div>
</div>
{% endblock %}