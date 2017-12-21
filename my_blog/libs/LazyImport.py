#-*- coding:UTF-8 -*-
#自定义懒加载类
class LazyImport:
    def __init__(self, module_name):
        self.module_name = module_name
        self.module = None

    def __getattr__(self, funcname):
        if self.module is None:
            self.module = __import__(self.module_name)
            print(self.module)
        return getattr(self.module, funcname)
