var mongoose = require('mongoose'),
    Schema = mongoose.Schema,
    imageSchema = mongoose.Schema({
        chapter: { type: Schema.Types.ObjectId, ref: 'Chapter'},
        name: String,
        nomor: String
    }, {
        timestamps:true
    })

module.exports = mongoose.model('Image', imageSchema)