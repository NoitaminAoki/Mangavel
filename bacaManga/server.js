// const == var == let
var express = require('express'),
    bodyParser = require('body-parser'),
    port = 1234,
    app = express(),
    dbConfig = require('./config/database'),
    mongoose = require('mongoose'),
    path = require("path")


app.use(bodyParser.urlencoded({
    extended : true
}))


app.set('views', path.join(__dirname, 'views'))
app.set('view engine', 'ejs')

app.use(bodyParser.json())

mongoose.Promise = global.Promise

mongoose.connect(dbConfig.url, {
    useNewUrlParser: true
}).then(() => {
    console.log("Successfully connected to the database")
}).catch(err => {
    console.log("Could not connect to the database. Exiting now...", err)
    process.exit()
})

require('./routes/mangaRoute')(app)
require('./routes/chapterRoute')(app)
require('./routes/imageRoute')(app)

app.listen(port, () => {
    console.log("Server is listen to "+ port)
})
