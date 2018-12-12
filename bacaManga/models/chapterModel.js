var mongoose = require('mongoose'),
    Schema = mongoose.Schema,
    chapterSchema = mongoose.Schema({
        manga: { type: Schema.Types.ObjectId, ref: 'Manga'},
        nomor: String,
        judul: String
    }, {
        timestamps:true
    })

module.exports = mongoose.model('Chapter', chapterSchema)