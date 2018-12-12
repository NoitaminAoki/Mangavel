var mongoose = require('mongoose'),
    Schema = mongoose.Schema,
    mangaSchema = mongoose.Schema({
        judul: String,
        sinopsis: String,
        image: String,
        // chapter: [{ type: Schema.Types.ObjectId, ref: 'Chapter'}]
    }, {
        timestamps: true
    })

module.exports = mongoose.model('Manga', mangaSchema)



