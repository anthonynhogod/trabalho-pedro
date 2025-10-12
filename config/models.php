<?php
require_once __DIR__ . "/database.php"; // garante o caminho correto

class Turma {
    public static function criar($nome, $id_professor) {
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO turmas (nome, id_professor) VALUES (?, ?)");
        return $stmt->execute([$nome, $id_professor]);
    }

    public static function listarPorProfessor($id_professor) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM turmas WHERE id_professor = ?");
        $stmt->execute([$id_professor]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function listarTodos() {
        global $pdo;
        $result = $pdo->query("SELECT * FROM turmas");
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
}

class Aula {
    public static function criar($id_turma, $titulo, $data) {
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO aulas (id_turma, titulo, data) VALUES (?, ?, ?)");
        return $stmt->execute([$id_turma, $titulo, $data]);
    }

    public static function listarPorTurma($id_turma) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM aulas WHERE id_turma = ?");
        $stmt->execute([$id_turma]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function listarPorAluno($id_aluno) {
        global $pdo;
        $stmt = $pdo->prepare("
            SELECT a.*, t.nome AS turma
            FROM aulas a
            JOIN turmas t ON t.id = a.id_turma
            JOIN turma_aluno ta ON ta.id_turma = t.id
            WHERE ta.id_aluno = ?
        ");
        $stmt->execute([$id_aluno]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

class Presenca {
    public static function marcar($id_aula, $id_aluno, $presente) {
        global $pdo;
        $stmt = $pdo->prepare("
            INSERT INTO presencas (id_aula, id_aluno, presente)
            VALUES (?, ?, ?)
            ON DUPLICATE KEY UPDATE presente = VALUES(presente)
        ");
        return $stmt->execute([$id_aula, $id_aluno, $presente]);
    }

    public static function listarPorAluno($id_aluno) {
        global $pdo;
        $stmt = $pdo->prepare("
            SELECT a.titulo, a.data, t.nome AS turma, p.presente
            FROM presencas p
            JOIN aulas a ON a.id = p.id_aula
            JOIN turmas t ON t.id = a.id_turma
            WHERE p.id_aluno = ?
            ORDER BY a.data DESC
        ");
        $stmt->execute([$id_aluno]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function listarPorAula($id_aula) {
        global $pdo;
        $stmt = $pdo->prepare("
            SELECT u.id, u.nome, COALESCE(p.presente, 0) AS presente
            FROM turma_aluno ta
            JOIN usuario u ON u.id = ta.id_aluno
            LEFT JOIN presencas p ON p.id_aluno = u.id AND p.id_aula = ?
            WHERE ta.id_turma = (
                SELECT id_turma FROM aulas WHERE id = ?
            )
        ");
        $stmt->execute([$id_aula, $id_aula]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

class TurmaAluno {
    public static function listarAlunos() {
        global $pdo;
        $stmt = $pdo->query("SELECT id, nome FROM usuario WHERE tipo = 'aluno'");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function listarPorTurma($id_turma) {
        global $pdo;
        $stmt = $pdo->prepare("
            SELECT u.id, u.nome 
            FROM turma_aluno ta
            JOIN usuario u ON u.id = ta.id_aluno
            WHERE ta.id_turma = ?
        ");
        $stmt->execute([$id_turma]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function adicionar($id_turma, $id_aluno) {
        global $pdo;
        $stmt = $pdo->prepare("INSERT IGNORE INTO turma_aluno (id_turma, id_aluno) VALUES (?, ?)");
        return $stmt->execute([$id_turma, $id_aluno]);
    }

    public static function remover($id_turma, $id_aluno) {
        global $pdo;
        $stmt = $pdo->prepare("DELETE FROM turma_aluno WHERE id_turma = ? AND id_aluno = ?");
        return $stmt->execute([$id_turma, $id_aluno]);
    }
}
