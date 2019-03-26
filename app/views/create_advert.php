{% extends 'templates/default.php' %}

{% block title %}Create advert{% endblock %}

{% block content %}

<div class="card" style="width: 70%">
    <div class="card-header">
        Please provide as much detail as you can.
    </div>
    <div class="card-body">
        <form id="form" name="form" class="first_login_form" action="{{ urlFor('create_advert.post')}}" method="post"
            enctype="multipart/form-data">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="car_manufacturer">Manufacturer</label>
                    <input type="text" class="form-control" id="car_manufacturer" name="car_manufacturer" required>
                </div>

                <div class="form-group col-md-6">
                    <label for="car_model">Model</label>
                    <input type="text" class="form-control" id="car_model" name="car_model" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="make_year">Make year</label>
                    <input type="number" class="form-control" id="make_year" name="make_year" required>
                </div>
                <div class="form-group col-md-3">
                    <label for="make_month">Make month</label>
                    <input type="number" class="form-control" id="make_month" name="make_month" required>
                </div>
                <div class="form-group col-md-3">
                    <label for="first_reg_year">First registration year</label>
                    <input type="number" class="form-control" id="first_reg_year" name="first_reg_year">
                </div>
                <div class="form-group col-md-3">
                    <label for="first_reg_month">First registration month</label>
                    <input type="number" class="form-control" id="first_reg_month" name="first_reg_month">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="car_mileage">Mileage (KM)</label>
                    <input type="number" class="form-control" id="car_mileage" name="car_mileage" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="car_price">Price</label>
                    <input type="number" class="form-control" id="car_price" name="car_price" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="engine_fuel">Fuel</label>
                    <input type="text" class="form-control" id="engine_fuel" name="engine_fuel" required>
                </div>
                <div class="form-group col-md-3">
                    <label for="engine_displacement">Displacement</label>
                    <input type="number" class="form-control" id="engine_displacement" name="engine_displacement">
                </div>
                <div class="form-group col-md-3">
                    <label for="engine_power">Power (kW)</label>
                    <input type="text" class="form-control" id="engine_power" name="engine_power">
                </div>
                <div class="form-group col-md-3">
                    <label for="engine_transmission">Transmission</label>
                    <input type="number" class="form-control" id="engine_transmission" name="engine_transmission">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="body_color">Color</label>
                    <input type="text" class="form-control" id="body_color" name="body_color">
                </div>
                <div class="form-group col-md-6">
                    <label for="body_door_count">Door count</label>
                    <input type="number" class="form-control" id="body_door_count" name="body_door_count">
                </div>
            </div>


            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control" rows="5"></textarea>
                </div>
            </div>

            <div class="form-row">
                <label>Add files (up to 4): </label>
                <input type="file" class="form-control" name="uploads[]" multiple="multiple" />
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 20px">Continue</button>
            <input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}" />
        </form>
    </div>
</div>
{% endblock %}