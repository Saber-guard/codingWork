#-*- coding:UTF-8 -*-
#自定义控制器类
from django.http import HttpResponse
from rest_framework.views import APIView

class Controller(APIView):

    #属性
    # post = {}
    # get = {}

    #初始化
    def __init__(self):
        #执行父类初始化方法
        APIView.__init__(self)
        # #获取request对象
        # self.request = request
        # #获取参数
        # self.getParam()
        # #输出
        self.echo = HttpResponse

    # def getParam(self):
    #     if not self.post:
    #         self.post = self.request.POST
    #     if not self.get:
    #         self.get = self.request.GET
    #     if hasattr(self.request,'module'):
    #         self.module = self.request.module
    #     if hasattr(self.request,'controller'):
    #         self.controller = self.request.controller
    #     if hasattr(self.request,'action'):
    #         self.action = self.request.action


