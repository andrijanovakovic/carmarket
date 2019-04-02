{% extends 'templates/default.php' %}

{% block title %}Comments{% endblock %}

{% block content %}


<div style="display: flex; flex-direction: column; width: 100%; align-items:center;">
    {% if comments_count > 0 %}
        {% for comment in comments %}
        <a href="{{ urlFor('advert.detail', { advert_id: comment.advert_id }) }}" class="card"
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
                        <p>Client ip: {{ comment.ip_address }}</p>
                        <p>Client country: {{ comment.ip_country_of_origin }}</p>
                    </div>
                </div>
            </div>
        </a>
        {% endfor %}
    {%else%}
        <div class="card"
            style="width: 70%;margin-bottom: 10px; text-decoration: none; height: 100px; padding: 10px">
            No comments in our db...
        </div>
    {%endif%}
</div>

{% endblock %}