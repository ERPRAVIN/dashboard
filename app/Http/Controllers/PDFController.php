<?php

namespace App\Http\Controllers;

use App\Models\Product;
use File;
use PDF;
use Storage;
use ZipArchive;

class PDFController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generatePDF($id)
    {

        $productArr = Product::find($id);
        $data = [
            'product_name' => $productArr->product_name,
            'product_price' => $productArr->product_price,
            'product_image' => $productArr->product_image,
        ];

        //$pdf = PDF::loadView('product_PDF', $data);
        // Storage::put('public/pdf/product'.$id.'.pdf', $pdf->output());
        //return view('product_PDF')->with($data);
        //return $pdf->download('product_PDF');

        $dompdf = PDF::loadView('product_PDF', $data);
        Storage::put('public/pdf/product' . $id . '.pdf', $dompdf->output());
        // return $dompdf->download('product_PDF');

        $public_dir = public_path();
        $zip = new ZipArchive;
        $zipname = 'product' . $id . '.zip';
        $pdffilename = 'product' . $id . '.pdf';
        $pdffilepath = public_path() . '/' . 'storage/pdf';

        if ($zip->open(public_path($zipname), ZipArchive::CREATE) == true) {

            $files = File::files(public_path('storage/pdf'));
            // foreach ($files as $key => $pdffilename) {

            $relativeNameInZipFile = basename($pdffilename);
            //     $zip->addFile(public_path($pdffilename), $relativeNameInZipFile);            TO ADD ALL PDF USE FOR EACH LOOP
            $zip->addFile(public_path('storage/pdf/' . $pdffilename), $relativeNameInZipFile);

            // }

            //dd('pdf added to zip');

            // Close ZipArchive
            $zip->close();
        }
         // Set Header
         $headers =  [
            'Content-Type' => 'application/octet-stream',
          ];
        //array(
        //     'Content-Type' => 'application/octet-stream',
        // );
        $filetopath=public_path($zipname);
        // Create Download Response
        $res = public_path($zipname);
        //dd($res);
        if (file_exists($res)) {
            $pdf =$dompdf->download('product_PDF');
            return response()->download($filetopath);
 
        }

    }
    public function downloadPDF($id)
    {
        $productArr = Product::find($id);
        $data = [
            'product_name' => $productArr->product_name,
            'product_price' => $productArr->product_price,
            'product_image' => $productArr->product_image,
        ];
        $pdf = PDF::loadView('product_PDF', $data);
        Storage::put('public/pdf/product'.$id.'.pdf', $pdf->output());
       // return view('product_PDF')->with($data);
        return $pdf->download('product_PDF');
    }
}
