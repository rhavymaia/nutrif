package br.edu.ifpb.nutrif.service;

import java.util.Date;

import javax.ws.rs.*;
import javax.ws.rs.core.Response;
import javax.ws.rs.core.Response.ResponseBuilder;

import br.edu.ifpb.nutrif.controller.PessoaController;
import br.edu.ifpb.nutrif.entidade.Aluno;
import br.edu.ifpb.nutrif.entidade.Pessoa;
import br.edu.ifpb.nutrif.validade.StringValidade;

@Path("servicos")
public class NutrIFService {

	@GET
	@Path("digaolaservidor/")
	@Produces("application/json")
	public Server digaOlaServer() {
		
		Server server = new Server();
		server.setOnline(true);
		
		return server;

	}
	
	@GET
	@Path("/buscaraluno/{nome}")
	@Produces("application/json")
	public Aluno buscarAlunoPorNome( @PathParam("nome") String nome ) {

		Aluno aluno = new Aluno();
		aluno.setNome(nome);

		return aluno;
	}
	
	/**
	 * Login do passageiro atrav�s do email e senha.
	 * 
	 * @author Rhavy Maia Guedes
	 * @param pessoa
	 * @return
	 */
	@POST
	@Path("/loginpessoa")
	@Consumes("application/json")
	@Produces("application/json")
	public Response loginPessoa(Pessoa pessoa) {

		// Preview response: user unauthorize.
		ResponseBuilder builder = Response.status(Response.Status.UNAUTHORIZED)
				.entity("Incomple fields");
		builder.expires(new Date());

		// User data.
		String email = pessoa.getEmail();
		String password = pessoa.getPassword();

		if (!StringValidade.isEmpty(email) && !StringValidade.isEmpty(password)) {

			// Check user login.
			pessoa = PessoaController.loginPessoa(email, password);

			if (pessoa != null) {

				// user authorization.
				builder.status(Response.Status.OK);

				// Insert passenger
				builder.entity(pessoa);

			} else {
				
				builder.status(Response.Status.UNAUTHORIZED).entity(
						"Wrong combination of User Name/E-mail address "
								+ "and password");
			}
		}

		return builder.build();
	}
}