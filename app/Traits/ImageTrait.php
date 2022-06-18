<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait ImageTrait {

    /**
     * @param Request $request
     * @return $this|false|string
     */
    public function verifyAndUpload(Request $request, $fieldname, $directory = 'public') {
        if( $request->hasFile( $fieldname ) ) {
            if (!$request->file($fieldname)->isValid()) {
                flash('Invalid Image!')->error()->important();
                return redirect()->back()->withInput();
            }
            return $request->file($fieldname)->store($fieldname, $directory);
        }
        return null;
    }
}
