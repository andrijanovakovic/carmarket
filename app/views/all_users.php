{% extends 'templates/default.php' %}

{% block title %}All users{% endblock %}

{% block content %}

<div style="display: flex; flex-direction: column; width: 100%; align-items:center;">
    {% for user in users %}
    <div class="card" style="width:70%;margin-bottom:10px;">
        <div class="card-header" style="display: flex; flex-direction:row; justify-content: space-between;">
            <p style=" text-align:left">{{ user.user_info.first_name }} {{ user.user_info.last_name }} ({{user.username}})</p>
            <p style="text-align:right">Created: {{ user.created_at|date('d/M/Y H:s:i') }}</p>
        </div>
        <div class="card-body">
            <div class="container">
            Ad count: <span class="badge badge-secondary">{{user.ads_count}}</span></h1>
            </div>
        </div>
    </div>
    {% endfor %}
</div>

{% endblock %}