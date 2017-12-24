#-*- coding:UTF-8 -*-
#自定义请求类
import importlib
from libs.FunctionLib import *
from django.http import HttpResponse
from django.http import HttpResponseNotFound

class Route(object):

    #分发请求
    def relay(request):
        #解析path
        path = request.path
        pathinfo = path.split('/')

        # 获得 module,controller,action
        module = pathinfo[1] if isset(pathinfo,1) and pathinfo[1] else 'index'
        controller = pathinfo[2] if isset(pathinfo,2) and pathinfo[2] else 'index'
        action = pathinfo[3] if isset(pathinfo,3) and pathinfo[3] else 'index'
        request.module = module
        request.controller = controller
        request.action = action

        #控制器首字母大写
        module = module.capitalize()
        controller = controller.capitalize()
        action = action.capitalize()

        #分发请求
        try:
            m = importlib.import_module('apps.'+module,module)
        except:
            return HttpResponseNotFound('模块不存在')

        try:
            m = importlib.import_module(
                    'apps.'+module+'.controller.'+controller,controller)
            c = getattr(m, controller)
        except:
            return HttpResponseNotFound('控制器不存在')
        c = c(request)

        try:
            a = getattr(c, action)
        except:
            return HttpResponseNotFound('方法不存在')

        return a()
