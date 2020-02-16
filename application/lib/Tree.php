<?php 
	
	namespace application\lib;

	trait Tree 
	{
		public function selChild($table)
		{
         $query = "
            SELECT *
            FROM ".$table." 
            WHERE cod >= (SELECT cod FROM ".$table." WHERE id = :id) 
            AND cod < (SELECT MIN(cod) FROM ".$table."
                        WHERE cod > (SELECT cod FROM ".$table." WHERE id = :id)
                        AND lvl <= (SELECT lvl FROM ".$table." WHERE id = :id))
            AND lvl >= (SELECT lvl FROM ".$table." WHERE id = :id)
            AND lvl <= (SELECT lvl + 1 FROM ".$table." WHERE id = :id)
            AND cod < (SELECT MAX(cod) FROM ".$table.")
            ORDER BY cod";
         if (array_key_exists('id', $_GET)) 
         {
            $params = [
               'id' => htmlspecialchars($_GET['id']),
            ];  
         }
         else 
         {
            $params = [
               'id' => '1',
            ];
         }
         
         return $this->db->row($query, $params);
		}

      public function back($table)
      {
         if (array_key_exists('lvl', $_GET) && array_key_exists('cod', $_GET)) 
         {
            $params = [
               'cod' => htmlspecialchars($_GET['cod']),
            ];  
            if (htmlspecialchars($_GET['lvl']) == 0)
            {
               return false;
            }
         }
         else 
         {
            return false;
         }
         $query = "
            SELECT *
            FROM  ".$table."
            WHERE cod = (SELECT MAX(cod) FROM ".$table." WHERE (cod < :cod) AND
            (lvl < (SELECT lvl FROM ".$table." WHERE cod = :cod)))
         ";

         return $this->db->row($query, $params);
      }

      public function allAncestors($table)
      {
         if (array_key_exists('id', $_GET)) 
         {
            $params = [
               'id' => htmlspecialchars($_GET['id']),
            ];  
         }
         else 
         {
            $params = [
               'id' => '1',
            ];
         }

         $query = "
            SELECT   (SELECT description FROM ".$table." WHERE cod=MAX(a.cod)) AS description,
                     (SELECT id FROM ".$table." WHERE cod=MAX(a.cod)) AS id 
            FROM ".$table." a 
            WHERE a.cod<=(SELECT cod FROM ".$table." WHERE id = :id) 
            AND lvl <= (SELECT lvl FROM ".$table." WHERE id = :id) 
            GROUP BY a.lvl ORDER BY a.cod
         ";

         return $this->db->row($query, $params);
      }

	}
	
	/*

   SELECT (SELECT name FROM tree WHERE ord=MAX(a.ord)) AS name
FROM tree a WHERE a.ord<=(SELECT ord FROM tree WHERE id=14) 
AND dep <= (SELECT dep FROM tree WHERE id = 14) 
GROUP BY a.dep ORDER BY a.ord

	 DBGrid1->DataSource->DataSet->RecNo = 1;
   lvl = DBGrid1->Columns->Items[3]->Field->AsInteger;
   if (lvl == 0) {
      ShowMessage("Âû óæå â êîðíå!");
      Abort();
   };
   cod = DBGrid1->Columns->Items[2]->Field->AsInteger;
   ADOQuery1->SQL->Clear();
   ADOQuery1->SQL->Add(
      "SELECT * "
      "FROM  Tree "
      "WHERE cod = (SELECT MAX(cod) FROM Tree WHERE (cod < cod_b) AND "
      "(lvl < (SELECT lvl FROM Tree WHERE cod = cod_b)))"
   );
   ADOQuery1->Parameters->ParamByName("cod_b")->Value = cod;
   ADOQuery1->Open();
   DBGrid1->DataSource->DataSet->RecNo = 1;
   id = DBGrid1->Columns->Items[0]->Field->AsInteger;
   SelChild(id, ADOQuery1);
}

SELECT (SELECT description FROM component WHERE cod=MAX(a.cod)) AS description 
FROM component a 
WHERE a.cod<=(SELECT cod FROM component WHERE id=6) 
AND lvl <= (SELECT lvl FROM component WHERE id = 6) 
GROUP BY a.lvl ORDER BY a.cod

void SelAllTree(int idElem, TADOQuery *ADOQuery1) {
   //Ôóíêöèÿ âûâîäà ïîëíîãî äåðåâà ýë-òà
   ADOQuery1->SQL->Clear();
   ADOQuery1->SQL->Add(
      "SELECT * "
      "FROM Tree "
      "WHERE cod >= (SELECT cod FROM Tree WHERE Id = id_b) "
      "AND cod < (SELECT MIN(cod) FROM Tree "
                  "WHERE cod > (SELECT cod FROM Tree WHERE Id = id_b) "
                  "AND lvl <= (SELECT lvl FROM Tree WHERE Id = id_b)) "
      "ORDER BY cod"
   );
   ADOQuery1->Parameters->ParamByName("id_b")->Value = idElem;
   ADOQuery1->Open();
}
*/
