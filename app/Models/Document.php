<?php
//
//namespace App\Models;
//
//use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
//
//class Document extends Model
//{
//    use HasFactory;
//    protected $guarded = ['id'];
//    public function user()
//    {
//        return $this->belongsTo(User::class);
//    }
//
//    public function getFrontSideImagePathAttribute()
//    {
//        $front_side_image = Document::where('id', $this->id)->first()->front_side_image;
//        if (!$front_side_image) {
//            return asset('uploads/default.png');
//        }
//        return asset('uploads/users/' . $this->front_side_image);
//    }
//    public function getBackSideImagePathAttribute()
//    {
//        $back_side_image = Document::where('id', $this->id)->first()->back_side_image;
//        if (!$back_side_image) {
//            return asset('uploads/default.png');
//        }
//        return asset('uploads/users/' . $this->back_side_image);
//    }
//}
