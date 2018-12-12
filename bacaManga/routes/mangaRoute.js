var mangaController = require('../controllers/mangaController')

module.exports = (app) => {
    var manga = mangaController

    app.post('/manga', manga.create);
    app.get('/manga', manga.findAll);
    app.get('/manga/:mangaId', manga.findOne);
    app.put('/manga/:mangaId', manga.update);
    app.delete('/manga/:mangaId', manga.delete);

}