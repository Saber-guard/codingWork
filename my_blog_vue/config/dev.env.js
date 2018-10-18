'use strict'
const merge = require('webpack-merge')
const prodEnv = require('./prod.env')

module.exports = merge(prodEnv, {
  NODE_ENV: '"development"',
  API_URL: '"http://api.codingwork.com"',
  MQ_URL: '"mqtt://mq.codingwork.cn:1883"',
  DE_BUG: 'true',
})
