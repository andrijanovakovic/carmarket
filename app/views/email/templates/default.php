<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{% block title %}{% endblock %} | CarMarket</title>
</head>

<body>
    <div class="default_main_content">
        {% block content %} {% endblock %}
    </div>
    {% include 'templates/partials/footer.php' %}
</body>

</html>