{% extends 'templates/default.php' %}

{% block title %}Before you continue{% endblock %}

{% block content %}

<div class="card" style="width: 70%">
    <div class="card-header">
        Before you continue, we encourage you to fill in the fields below, so your buyers can easily get in touch with
        you.
    </div>
    <div class="card-body">
        <form class="first_login_form" action="{{ urlFor('first_login.post')}}" method="post">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="first_name">Firstname</label>
                    <input type="text" class="form-control" id="first_name" name="first_name">
                </div>

                <div class="form-group col-md-6">
                    <label for="last_name">Lastname</label>
                    <input type="text" class="form-control" id="last_name" name="last_name">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="country">Country</label>
                    <input type="text" class="form-control" id="country" name="country">
                </div>
                <div class="form-group col-md-3">
                    <label for="city">City</label>
                    <input type="text" class="form-control" id="city" name="city">
                </div>
                <div class="form-group col-md-4">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" name="address">
                </div>
                <div class="form-group col-md-2">
                    <label for="zip">Zip</label>
                    <input type="text" class="form-control" id="zip" name="zip">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="gsm_number">GSM 1</label>
                    <input type="text" class="form-control" id="gsm_number" name="gsm_number">
                </div>
                <div class="form-group col-md-4">
                    <label for="gsm_number_1">GSM 2</label>
                    <input type="text" class="form-control" id="gsm_number_1" name="gsm_number_1">
                </div>
                <div class="form-group col-md-4">
                    <label for="gsm_number_2">GSM 3</label>
                    <input type="text" class="form-control" id="gsm_number_2" name="gsm_number_2">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="stationary_number">Stationary 1</label>
                    <input type="text" class="form-control" id="stationary_number" name="stationary_number">
                </div>
                <div class="form-group col-md-4">
                    <label for="stationary_number_1">Stationary 2</label>
                    <input type="text" class="form-control" id="stationary_number_1" name="stationary_number_1">
                </div>
                <div class="form-group col-md-4">
                    <label for="stationary_number_2">Stationary 3</label>
                    <input type="text" class="form-control" id="stationary_number_2" name="stationary_number_2">
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Continue</button>
            <input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}" />
        </form>
    </div>
</div>
{% endblock %}