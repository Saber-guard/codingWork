#-*- coding:UTF-8 -*-
from apps.common.Api import Api


class Index(Api):
    def get(self,request,format=None):
        return self.echo(request.GET)
    def post(self,request,format=None):
        return self.echo(request.data)
    def put(self,request,format=None):
        return self.echo(request.data)
    def delete(self,request,format=None):
        return self.echo(request.data)
