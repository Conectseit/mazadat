<?php
//
//namespace App\Http\Resources\Api;
//
//use Illuminate\Http\Resources\Json\JsonResource;
//
//class AuctionResource extends JsonResource
//{
//    /**
//     * Transform the resource into an array.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
//     */
//    public function toArray($request)
//    {
//        $name = 'name_' . app()->getLocale();
//        $auction_terms = 'auction_terms_' . app()->getLocale();
//        $description = 'description_' . app()->getLocale();
//        return [
//            'name'                        => $this->serial_number,
//            'name'                        => $this->$name,
//            'description'                 => $this->$description,
//            'image'                       => $this->first_image_path,
//            'number_of_bids'              => $this->count_of_buyer,
//            'start_auction_price'         => $this->start_auction_price,
//            'value_of_increment'          => $this->value_of_increment,
//            'remaining_time'              => $this->remaining_time,
////            'inspection_report'           => $this->inspection_report_image_path,
////            'Terms & Conditions'          => $this->$auction_terms,
////            'images'                      =>  AuctionImagesResource ::collection ($this->auctionimages),
//        ];
//    }
//}
