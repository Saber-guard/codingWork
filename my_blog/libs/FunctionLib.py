#-*- coding:UTF-8 -*-
def isset(arr,key):
    try:
        arr[key]
    except IndexError:
        return False
    return True