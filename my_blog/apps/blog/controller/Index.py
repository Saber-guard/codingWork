#-*- coding:UTF-8 -*-
from apps.common.Api import Api


class Index(Api):
    def index(self):
        return self.echo(self.module+'.'+self.controller+'.'+self.action)
