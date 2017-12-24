#-*- coding:UTF-8 -*-
#自定义控制器类
from django.http import HttpResponse
# import requests

class Controller(object):

    #属性
    post = {}、
    get = {}
    module = ''
    controller = ''
    action = ''

    #初始化
    def __init__(self,request):
        self.request = request
        #获取参数
        self.getParam()
        #输出
        self.echo = HttpResponse

    def getParam(self):
        if not self.post:
            self.post = self.request.POST
        if not self.get:
            self.get = self.request.GET
        if hasattr(self.request,'module'):
            self.module = self.request.module
        if hasattr(self.request,'controller'):
            self.controller = self.request.controller
        if hasattr(self.request,'action'):
            self.action = self.request.action

    # def toPost(self,url='',param={},headers={}):
    #     response = requests.post(url=url,data=param,headers=headers)
    #     return response
    #
    # def toGet(self,url='',param={},headers={}):
    #     response = requests.post(url=url, params=param,headers=headers)
    #     return response
