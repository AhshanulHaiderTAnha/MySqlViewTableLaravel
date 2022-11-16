<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement($this->createView());
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::statement($this->dropView());
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    private function createView(): string
    {
        return <<<SQL
            CREATE VIEW view_user_data AS
                SELECT 
                    users.id, 
                    users.name, 
                    users.email,
                    (SELECT count(*) FROM posts
                                WHERE posts.user_id = users.id
                            ) AS total_posts
                FROM users
            SQL;

            // CREATE VIEW all_pdfs_new  AS
            // SELECT focus_sessionpdf.id AS "pdf_id", focus_sessionpdf.admin_id AS "creator_id",focus_sessionpdf.user_id AS "fuser_id",focus_sessionpdf.pdfname AS "name_of_pdf",focus_sessionpdf.pdfunique AS "pdf_url" ,focus_sessionpdf.created_at AS "created_at",focus_sessionpdf.pdf_type AS "pdf_type"
            // FROM focus_sessionpdf
            // UNION
            // SELECT pdfs.id AS "pdf_id", pdfs.user_id AS "creator_id",pdfs.subuser_id AS "fuser_id",pdfs.name AS "name_of_pdf", pdfs.pdf AS "pdf_url",pdfs.created_at AS "created_at",pdfs.type AS "pdf_type"
            // FROM pdfs;

                }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    private function dropView(): string
    {
        return <<<SQL
            DROP VIEW IF EXISTS `view_user_data`;
            SQL;
    }

}
