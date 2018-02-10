#-*- coding:UTF-8 -*-
#分类模型

from django.db import models

class Category(models.Model):
    name = models.CharField(max_length=20)
    parent_id = models.ForeignKey('self',null=True,on_delete=models.CASCADE)
    parent_path = models.CharField(max_length=128,blank=True)
    # content_model = models.IntegerField(default=1)
    # pic = models.ImageField(blank=True)
    # describe = models.CharField(max_length=128,blank=True)
    mark = models.CharField(max_length=128,blank=True)
