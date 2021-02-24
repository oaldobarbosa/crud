<?php
/*
    Criação da classe Usuario com o CRUD
*/
class UsuarioDAO{
    




    
    //criar usuários
    public function create(Usuario $usuario) {
        try {

            $sql = "INSERT INTO usuario (cpf, nome, sobrenome, idade, sexo) VALUES (:cpf, :nome, :sobrenome, :idade, :sexo)";
            $p_sql = Conexao::getConexao()->prepare($sql);
            $p_sql->bindValue(":cpf", $usuario->getCpf());
            $p_sql->bindValue(":nome", $usuario->getNome());
            $p_sql->bindValue(":sobrenome", $usuario->getSobrenome());
            $p_sql->bindValue(":idade", $usuario->getIdade());
            $p_sql->bindValue(":sexo", $usuario->getSexo());
            
            return $p_sql->execute();

        } catch (Exception $e) {
            print "Erro ao Inserir usuario <br>" . $e . '<br>';
        }
    }




    //read todos
    public function read() {
        try {

            $sql = "SELECT * FROM usuario order by nome asc";

            $result = Conexao::getConexao()->query($sql);

            $lista = $result->fetchAll(PDO::FETCH_ASSOC);
            $f_lista = array();


            foreach ($lista as $l) {
                $f_lista[] = $this->listaUsuarios($l);
            }


            return $f_lista;


        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Buscar Todos." . $e;
        }
    }
    





    //alterar dados
    public function update(Usuario $usuario) {
        try {
            $sql = "UPDATE usuario setnome=:nome, sobrenome=:sobrenome, idade=:idade, sexo=:sexo WHERE cpf = :cpf";

            $p_sql = Conexao::getConexao()->prepare($sql);


            $p_sql->bindValue(":nome", $usuario->getNome());
            $p_sql->bindValue(":sobrenome", $usuario->getSobrenome());
            $p_sql->bindValue(":idade", $usuario->getIdade());
            $p_sql->bindValue(":sexo", $usuario->getSexo());
            $p_sql->bindValue(":cpf", $usuario->getCpf());

            return $p_sql->execute();




        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar fazer Update<br> $e <br>";
        }
    }






    //deletar dados
    public function delete(Usuario $usuario) {
        try {

            // sql para deletar comparando com o cpf
            $sql = "DELETE FROM usuario WHERE cpf = :cpf";

            $p_sql = Conexao::getConexao()->prepare($sql);

            $p_sql->bindValue(":cpf", $usuario->getCpf());

            return $p_sql->execute();


        } catch (Exception $e) {

            echo "Erro ao Excluir usuario<br> $e <br>";

        }
    }





    
    //mostrar todos os clientes
    private function listaUsuarios($row) {


        $usuario = new Usuario();
        $usuario->setCpf($row['cpf']);
        $usuario->setNome($row['nome']);
        $usuario->setSobrenome($row['sobrenome']);
        $usuario->setIdade($row['idade']);
        $usuario->setSexo($row['sexo']);


        return $usuario;
    }
 }

 ?>
