#-*- coding:UTF-8 -*-
#自定义请求类
import importlib

class Route(object):

    #分发请求
    def relay(request):
        #解析path
        path = request.path
        pathinfo = path.split('/')

        #获得 module,controller,action
        try:
            module = pathinfo[1]
            controller = pathinfo[2]
            action = pathinfo[3]
        except IndexError as e:
            pass

        module = module if 'module' in dir() and module else 'index'
        controller = controller if 'controller' in dir() and controller else 'index'
        action = action if 'action' in dir() and action else 'index'

        #控制器首字母大写
        controller = controller.capitalize()

        #分发请求
        m = importlib.import_module('apps.'+module+'.controller.'+controller,controller)
        c = getattr(m, controller)
        c = c()
        a = getattr(c,action)

        return a(request)
