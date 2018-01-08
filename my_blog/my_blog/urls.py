"""my_blog URL Configuration

The `urlpatterns` list routes URLs to views. For more information please see:
    https://docs.djangoproject.com/en/1.11/topics/http/urls/
Examples:
Function views
    1. Add an import:  from my_app import views
    2. Add a URL to urlpatterns:  url(r'^$', views.home, name='home')
Class-based views
    1. Add an import:  from other_app.views import Home
    2. Add a URL to urlpatterns:  url(r'^$', Home.as_view(), name='home')
Including another URLconf
    1. Import the include() function: from django.conf.urls import url, include
    2. Add a URL to urlpatterns:  url(r'^blog/', include('blog.urls'))
"""
from django.conf.urls import url,include
from django.contrib import admin


from libs.Route import Route
from apps.blog.controller.Index import Index


urlpatterns = [
    url(r'^admin', admin.site.urls),
    url(r'^api-auth/', include('rest_framework.urls')),

    #动态路由
    url('^(?P<app>(\w+))/(?P<controller>(\w+))/$',Route.relay),
    url('^(?P<app>(\w+))/$',Route.relay,{'controller':'index'}),
    url(r'^$',Route.relay,{'app':'blog','controller':'index'}),
]

