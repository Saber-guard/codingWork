from django.shortcuts import render
from django.http import HttpResponse

class Index(object):
    def index(self,request):
        return HttpResponse('aaa')