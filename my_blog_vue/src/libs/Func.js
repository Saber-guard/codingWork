class Func {

  // 将数组分段为小数组
  group(array, length) {
    var index = 0;
    var newArray = [];

    while(index < array.length) {
      newArray.push(array.slice(index, index += length));
    }

    return newArray;
  }
  in_array(element,array){
    if (!array instanceof Array) {
      return false
    }

    for (var i in array) {
      if (array[i] == element) {
        return true
      }
    }
    return false
  }

  pop_one(element,array) {
    var index = array.indexOf(element);
    if (index > -1) {
      array.splice(index, 1);
    }
  }


}

export default new Func()
