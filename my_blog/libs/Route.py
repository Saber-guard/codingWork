#-*- coding:UTF-8 -*-
#自定义请求类
import importlib
from libs.FunctionLib import *
from django.http import HttpResponse
from django.http import HttpResponseNotFound

class Route(object):

    #分发请求
    def relay(request,**kwargs):

        app = kwargs.get('app', None)
        controller = kwargs.get('controller', None)
        app = app.lower()
        controller = controller.lower().capitalize()

        try:
            appObj = importlib.import_module('apps.'+app,app)
            controllerObj = getattr(appObj.controller, controller)
            controllerObj = getattr(controllerObj, controller)

        except (ImportError, AttributeError) as e:
            # 导入失败时，自定义404错误
            return HttpResponseNotFound('404 Not Found')
        except Exception as e:
            # 代码执行异常时，自动跳转到指定页面
            # return redirect('/app01/index/')
            pass

        return controllerObj.as_view()(request,kwargs)


