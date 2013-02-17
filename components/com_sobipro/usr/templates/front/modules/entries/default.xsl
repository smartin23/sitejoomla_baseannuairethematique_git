<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:php="http://php.net/xsl">	
<xsl:import href="vcardheader.xsl" />
	<xsl:template match="/EntriesModule">

			<xsl:for-each select="entries/entry">
				<div class="entry">
					<a>
					<xsl:attribute name="href">
					  <xsl:value-of select="url" />
					</xsl:attribute>
						<xsl:call-template name="vcardheader" />
					</a>
				</div>
			</xsl:for-each>		

	</xsl:template>
</xsl:stylesheet>
