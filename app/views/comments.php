{% extends 'templates/default.php' %}

{% block title %}Comments{% endblock %}

{% block content %}

<div style="display: flex; flex-direction: column; width: 100%; align-items:center;">
    {% for comment in comments %}
    <a href="{{ urlFor('advert.detail', { advert_id: comment.advert_id }) }}" class="card advert"
        style="width: 70%;margin-bottom: 10px; text-decoration: none;">
        <div>
            <div class="card-header" style="display: flex; flex-direction:row; justify-content: space-between;">
                <p style=" text-align:left">{{ comment.value }}</p>

                <p style="text-align:right">Posted: {{ comment.created_at|date('d/M/Y H:s:i') }}</p>
            </div>
            <div class="card-body">
                <div class="container">
                    <p>Posted by (email): {{ comment.email }}</p>
                    <p>Posted by (nickname): {{ comment.nickname }}</p>
                </div>
            </div>
        </div>
    </a>
    {% endfor %}
</div>

{% endblock %}