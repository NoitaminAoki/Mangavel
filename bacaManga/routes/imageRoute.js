var imageController = require('../controllers/imageController')

module.exports = (app) => {
    var image = imageController

    app.post('/image', image.create);
    app.get('/image/chapter/:chapterId', image.findAllByChapter);
    app.get('/image/:imageId', image.findOne);
    app.put('/image/:imageId', image.update);
    app.delete('/image/:imageId', image.delete);

}