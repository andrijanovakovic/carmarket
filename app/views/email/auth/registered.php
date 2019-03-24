{% extends "email/templates/default.php" %}

{% block content %}
<b>Thanks for registering!</b>
<p>You can start using CarMarket in just seconds, click the link below to activate you account</p>
<br/>
<p>Link: {{base_url}}{{ urlFor('activate') }}?email={{ user.email}}&identifier={{ identifier|url_encode }}</p>
<br/>
<br/>
{% endblock %}