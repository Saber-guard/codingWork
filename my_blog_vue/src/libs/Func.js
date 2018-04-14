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
}

export default new Func()
